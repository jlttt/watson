<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use jlttt\watson\Clock\ManageableClock;
use jlttt\watson\Clock\SystemClock;
use jlttt\watson\Frame\Frames;
use jlttt\watson\Watson;

/**
 * Defines application features from the specific context.
 */
class ProjectContext implements Context
{
    private $application;
    private $project;

    public function __construct() {
        $this->application = new Watson();
    }
    /**
     * @Given I have a project :name
     */
    public function iHaveAProject($name)
    {
        $this->application->addProject($name);
    }

    /**
     * @When I search the project by name :name
     */
    public function iSearchTheProjectByName($name)
    {
        $this->project = $this->application->getProjects()->findByName($name);
    }

    /**
     * @Then I should obtain a project named :name
     */
    public function iShouldObtainAProjectNamed($name)
    {
        if (!$this->project->hasName($name)) {
            throw new \Exception("Project with name " . $name . " expected, but none found.");
        }
    }

    /**
     * @Then I should obtain no project
     */
    public function iShouldObtainNoProject()
    {
        if (!is_null($this->project)) {
            throw new \Exception("No project with name " . $name . " expected, but at least one found.");
        }
    }

}
