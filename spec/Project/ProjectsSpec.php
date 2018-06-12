<?php

namespace spec\jlttt\watson\Project;

use jlttt\watson\Project\Projects;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProjectsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Projects::class);
    }
}
