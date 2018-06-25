<?php

namespace jlttt\watson;

use jlttt\watson\Project\Project;

class Watson
{
    private $projects;

    public function __construct()
    {
        $this->projects = array();
    }

    public function getProjects()
    {
        return $this->projects;
    }

    public function addProject(Project $project)
    {
        if (!$this->findProjectByName($project->getName())) {
            $this->projects[] = $project;
        }
    }

    public function findProjectByName($name)
    {
        foreach ($this->projects as $project) {
            if ($project->hasName($name)) {
                return $project;
            }
        }
        return null;
    }
}
