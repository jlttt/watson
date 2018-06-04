<?php
namespace jlttt\watson\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DescribeCommand extends Command
{
    protected function configure()
    {
        $this->setName('describe');
        $this->setDescription('What is Watson.');
        $this->setHelp('This command gives a short description on what is Watson');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write(<<<TEXT
Watson is a tool aimed at helping you monitoring your time.

You just have to tell Watson when you start working on your
project with the `start` command, and you can stop the timer
when you're done with the `stop` command.

TEXT
        );
    }
}
