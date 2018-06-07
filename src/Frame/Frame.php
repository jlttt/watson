<?php

namespace jlttt\watson\Frame;

class Frame
{
    private $project;
    private $start;
    private $end;

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

    public function setStart($time)
    {
        $this->start = new \DateTime($time);
    }

    public function setStop($time)
    {
        $this->end = new \DateTime($time);
    }

    public function getDuration()
    {
        return $this->end->diff($this->start)->format('%H:%I:%S');
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getStop()
    {
        return $this->end;
    }

    public function isFinished()
    {
        return !is_null($this->end);
    }
}
