<?php

namespace spec\jlttt\watson\Clock;

use jlttt\watson\Clock\SystemClock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SystemClockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SystemClock::class);
    }
}
