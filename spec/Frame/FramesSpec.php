<?php

namespace spec\jlttt\watson\Frame;

use jlttt\watson\Frame\Frames;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FramesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Frames::class);
    }

    function it_contains_no_frames_by_default()
    {
        $this->count()->shouldReturn(0);
    }

    function it_starts_a_new_frame()
    {
        $this->start()->shouldReturnAnInstanceOf('jlttt\watson\Frame\Frame');
        $this->count()->shouldReturn(1);
    }
}
