<?php

namespace jlttt\watson\Frame;

use jlttt\watson\Clock\ClockInterface;

class Frames
{
    private $frames;
    private $running;
    private $clock;

    public function __construct(ClockInterface $clock)
    {
        $this->clock = $clock;
        $this->running = null;
        $this->frames = [];
    }

    public function start($project)
    {
        if ($this->hasRunning()) {
            throw new \Exception("A frame is already in progress");
        }
        $frame = new Frame($project);
        $frame->setStart($this->clock->now());
        $this->frames[] = $frame;
        $this->running = $frame;
        return $frame;
    }

    public function count()
    {
        return count($this->frames);
    }

    public function hasRunning()
    {
        return !empty($this->running);
    }

    public function getRunning()
    {
        if (!$this->hasRunning()) {
            throw new \Exception("No frame in progress");
        }
        return $this->running;
    }

    public function stop()
    {
        $frame = $this->running;
        if ($this->hasRunning()) {
            $this->running->end();
            $this->running->setStop($this->clock->now());
            $this->running = null;
        }
        return $frame;
    }
}
