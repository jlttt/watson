<?php

namespace jlttt\watson\Frame;

class Frames
{
    private $frames;

    public function __construct()
    {
        $this->frames = [];
    }

    public function start()
    {
        $frame = new Frame();
        $this->frames[] = $frame;
        return $frame;
    }

    public function count()
    {
        return count($this->frames);
    }
}
