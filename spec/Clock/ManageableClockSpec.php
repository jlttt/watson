<?php

namespace spec\jlttt\watson\Clock;

use jlttt\watson\Clock\ManageableClock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ManageableClockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ManageableClock::class);
    }

    function it_freeze_at_given_time()
    {
        $frozenTime = '2018-01-01 00:00:00';
        $this->freezeAt($frozenTime);
        $this->now()->shouldReturn($frozenTime);
    }
}
