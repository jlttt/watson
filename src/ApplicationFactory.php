<?php

namespace jlttt\watson;

use Symfony\Component\Console\Application;
use jlttt\watson\Command\DescribeCommand;

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

    public function create() {
        $application = new Application($this->getName(), $this->getVersion());

        $descriptionCommand = new DescribeCommand();
        $application->add($descriptionCommand);
        $application->setDefaultCommand($descriptionCommand->getName());

        return $application;
    }
    
}