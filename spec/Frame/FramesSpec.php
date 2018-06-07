<?php

namespace spec\jlttt\watson\Frame;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use org\bovigo\vfs\vfsStream;
use jlttt\watson\Frame\Frames;
use jlttt\watson\Clock\ClockInterface;

class FramesSpec extends ObjectBehavior
{
    const FILE_CONTENT = <<<JSON
[
    {
        "project":"First Project",
        "start":"2018-01-01 00:00:00",
        "end":"2018-01-01 00:01:27"
    },
    {
        "project":"Second Project",
        "start":"2018-01-02 00:00:00"
    }
]
JSON;

    private $workDir;
    private $clock;

    public function let(ClockInterface $clock)
    {
        $this->clock = $clock;
        $this->clock->now()->willReturn('2018-01-01 00:00:00');
        $this->beConstructedWith($this->clock);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Frames::class);
    }

    function it_contains_no_frames_by_default()
    {
        $this->count()->shouldReturn(0);
    }

    function it_starts_a_new_frame_for_project()
    {
        $this->start("New Project")->shouldReturnAnInstanceOf('jlttt\watson\Frame\Frame');
        $this->count()->shouldReturn(1);
    }

    function it_has_no_running_frame()
    {
        $this->hasRunning()->shouldReturn(false);
    }

    function it_has_running_frame()
    {
        $this->start("New project");
        $this->hasRunning()->shouldReturn(true);
    }

    function it_runs_only_one_frame()
    {
        $this->start("First project");
        $this->shouldThrow('\Exception')->during('start', array("Second project"));
    }

    function it_returns_running_frame()
    {
        $frame = $this->start("New project");
        $this->getRunning()->shouldReturn($frame);
    }

    function it_returns_no_running_frame()
    {
        $this->shouldThrow('\Exception')->during('getRunning');
    }

    function it_stops_nothing()
    {
        $this->stop()->shouldReturn(null);
        $this->hasRunning()->shouldReturn(false);
    }

    function it_stops_the_running_frame()
    {
        $frame = $this->start("First project");
        $this->stop()->shouldReturn($frame);
        $this->hasRunning()->shouldReturn(false);
    }

    function it_loads_frames()
    {
        $this->workDir = vfsStream::setup('workDir');
        $this->createFile('frames.json', self::FILE_CONTENT
        );
        $this->load('vfs://workDir/frames.json');
        $this->count()->shouldReturn(2);
        $this->hasRunning()->shouldReturn(true);
    }

    function it_saves_frames()
    {
        $this->workDir = vfsStream::setup('workDir');
        $this->start("First Project");
        $this->clock->now()->willReturn('2018-01-01 00:01:27');
        $this->stop();
        $this->clock->now()->willReturn('2018-01-02 00:00:00');
        $this->start("Second Project");
        $this->save('vfs://workDir/frames.json');
        $this->clear();
        $this->load('vfs://workDir/frames.json');
        $this->count()->shouldReturn(2);
        $this->hasRunning()->shouldReturn(true);
    }

    private function createFile($path, $content)
    {
        $file = vfsStream::newFile($path);
        $file->setContent($content);

        $this->workDir->addChild($file);
    }

    private function getFileContent($fileName)
    {
        return file_get_contents($fileName);
    }

    public function it_returns_all_frames()
    {
        $this->start("First Project");
        $this->clock->now()->willReturn('2018-01-01 00:01:27');
        $this->stop();
        $this->clock->now()->willReturn('2018-01-02 00:00:00');
        $this->start("Second Project");
        $all = $this->all();
        $all->shouldHaveCount(2);
    }
}
