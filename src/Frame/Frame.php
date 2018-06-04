<?php

namespace jlttt\watson\Frame;

class Frame
{
    private $project;

    public function __construct($project)
    {
        $this->project = $project;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function end()
    {
    }
}
