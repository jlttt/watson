<?php

namespace jlttt\watson\Frame;

class Frames
{
    private $frames;
    private $running;

    public function __construct()
    {
        $this->frames = [];
    }

    public function start($project)
    {
        if ($this->hasRunning()) {
            throw new \Exception("A frame is already in progress");
        }
        $frame = new Frame($project);
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
        if ($this->hasRunning()) {
            $this->running->end();
            $this->running = null;
        }
    }
}
