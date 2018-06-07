<?php

namespace jlttt\watson\Command;

use jlttt\watson\Clock\SystemClock;
use jlttt\watson\Frame\Frames;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends FileSystemCommand
{
    protected function configure()
    {
        $this->setName('start');
        $this->addArgument('project', InputArgument::REQUIRED, "The username of the user.");
        $this->setDescription('Start a new frame.');
        $this->setHelp('This command start a new frame for the given project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userWatsonFrameFile = $this->getUserWatsonFrameFile();

        $frames = new Frames(new SystemClock());
        $frames->load($userWatsonFrameFile);
        $frames->start($input->getArgument('project'));
        $frames->save($userWatsonFrameFile);
    }
}
