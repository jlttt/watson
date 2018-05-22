<?php

namespace spec\jlttt\watson\Frame;

use jlttt\watson\Frame\Frame;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FrameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Frame::class);
    }
}
