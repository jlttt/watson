<?php

namespace jlttt\watson\Command;

use jlttt\watson\Clock\SystemClock;
use jlttt\watson\Frame\Frames;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HistoryCommand extends FileSystemCommand
{
    protected function configure()
    {
        $this->setName('history');
        $this->setDescription('List the frames.');
        $this->setHelp('This command list the frames');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userWatsonFrameFile = $this->getUserWatsonFrameFile();

        $frames = new Frames(new SystemClock());
        $frames->load($userWatsonFrameFile);
        foreach ($frames->all() as $frame) {
            $formatted = [
                'project' => str_pad(substr($frame->getProject(), 0, 15), 15, ' ', STR_PAD_RIGHT),
                'start' => $frame->getStart()->format('Y-m-d H:i:s'),
                'end' => $formatted['end'] = str_repeat(' ', 19),
                'duration' => 'IN PROGRESS',
            ];
            $end = $frame->getStop();
            if (!empty($end)) {
                $formatted['end'] = $end->format('Y-m-d H:i:s');
                $formatted['duration'] = '(' . $frame->getDuration() .')';
            }
            $output->writeln(implode("\t", $formatted));
        }
    }
}

