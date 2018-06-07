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

    public function load($fileName)
    {
        $frameDataList = json_decode(file_get_contents($fileName), true);
        foreach ($frameDataList as $frameData) {
            $frame = new Frame($frameData['project']);
            $frame->setStart($frameData['start']);
            $this->running = $frame;
            if (!empty($frameData['end'])) {
                $frame->setStop($frameData['end']);
                $this->running = null;
            }
            $this->frames[] = $frame;
        }
    }

    public function save($fileName)
    {
        $frameDataList = [];
        foreach ($this->frames as $frame) {
            $frameData = [
                'project' => $frame->getProject(),
                'start' => $frame->getStart()->format('Y-m-d H:i:s'),
            ];
            if ($frame->isFinished()) {
                $frameData['end'] = $frame->getStop()->format('Y-m-d H:i:s');
            }
            $frameDataList[] = $frameData;
        }
        file_put_contents($fileName, json_encode($frameDataList));
    }

    public function clear()
    {
        $this->frames = [];
        $this->running = null;
    }

    public function all()
    {
        return $this->frames;
    }
}
