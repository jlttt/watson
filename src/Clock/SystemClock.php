<?php

namespace jlttt\watson\Clock;

class SystemClock implements ClockInterface
{
    public function now() {
        $dateTime = new \DateTime();
        return $dateTime->format('Y-m-d H:i:s');
    }
}
