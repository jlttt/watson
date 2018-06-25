<?php

namespace spec\jlttt\watson;

use jlttt\watson\Watson;
use jlttt\watson\Project\Project;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WatsonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Watson::class);
    }

    function it_should_have_no_project_by_default()
    {
        $this->getProjects()->shouldHaveCount(0);
    }

    function it_should_add_project()
    {
        $this->addProject(new Project("new Project"));
        $this->getProjects()->shouldHaveCount(1);
    }

    function it_should_not_add_project_if_already_exists()
    {
        $this->addProject(new Project("new Project"));
        $this->addProject(new Project("new Project"));
        $this->getProjects()->shouldHaveCount(1);
    }

    function it_should_not_find_project_by_name()
    {
        $this->findProjectByName("new Project")->shouldReturn(null);
    }

    function it_should_find_project_by_name()
    {
        $this->addProject(new Project("new Project"));
        $this->findProjectByName("new Project")->shouldReturn(null);
    }
}
