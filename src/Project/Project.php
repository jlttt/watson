<?php

namespace jlttt\watson\Project;

class Project
{
    private $name;

    public function __construct()
    {

    }

    public function getName()
    {
        return $this->name;
    }

    public function hasName($name)
    {
        return $this->name == $name;
    }

}