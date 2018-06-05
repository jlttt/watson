<?php

namespace spec\jlttt\watson\Frame;

use jlttt\watson\Frame\Frame;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FrameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith("project");
        $this->shouldHaveType(Frame::class);
    }

    function it_returns_the_duration()
    {
        $this->beConstructedWith("project");
        $this->setStart('2018-01-01 00:00:00');
        $this->setStop('2018-01-01 00:01:00');
        $this->getDuration()->shouldReturn('00:01:00');
    }
}
