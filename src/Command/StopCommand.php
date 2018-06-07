<?php

namespace jlttt\watson\Command;

use jlttt\watson\Clock\SystemClock;
use jlttt\watson\Frame\Frames;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StopCommand extends FileSystemCommand
{
    protected function configure()
    {
        $this->setName('stop');
        $this->setDescription('Stop the frame in progress.');
        $this->setHelp('This command stop the frame in progress');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userWatsonFrameFile = $this->getUserWatsonFrameFile();

        $frames = new Frames(new SystemClock());
        $frames->load($userWatsonFrameFile);
        $frames->stop();
        $frames->save($userWatsonFrameFile);
    }
}
