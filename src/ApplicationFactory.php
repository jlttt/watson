<?php

namespace jlttt\watson;

use Symfony\Component\Console\Application;
use jlttt\watson\Command\DescribeCommand;
use jlttt\watson\Command\StartCommand;
use jlttt\watson\Command\StopCommand;
use jlttt\watson\Command\HistoryCommand;

class ApplicationFactory
{
    const VERSION = '0.1-dev';
    /**
     * {@inheritdoc}
     */
    protected function getName()
    {
        return 'watson';
    }
    /**
     * {@inheritdoc}
     */
    protected function getVersion()
    {
        return self::VERSION;
    }

    public function create()
    {
        $application = new Application($this->getName(), $this->getVersion());

        $descriptionCommand = new DescribeCommand();
        $application->add($descriptionCommand);
        $startCommand = new StartCommand();
        $application->add($startCommand);
        $stopCommand = new StopCommand();
        $application->add($startCommand);
        $historyCommand = new HistoryCommand();
        $application->add($historyCommand);
        $application->setDefaultCommand($descriptionCommand->getName());

        return $application;
    }
}
