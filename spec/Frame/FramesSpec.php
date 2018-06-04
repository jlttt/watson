<?php

namespace spec\jlttt\watson\Frame;

use jlttt\watson\Frame\Frames;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FramesSpec extends ObjectBehavior
{
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
        $this->stop();
        $this->hasRunning()->shouldReturn(false);
    }

    function it_stops_the_running_frame()
    {
        $this->start("First project");
        $this->stop();
        $this->hasRunning()->shouldReturn(false);
    }
}
