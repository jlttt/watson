<?php

namespace jlttt\watson\Clock;

class ManageableClock implements ClockInterface
{
    private $now;

    public function freezeAt($time)
    {
        $this->now = $time;
    }

    public function now()
    {
        return $this->now;
    }
}
