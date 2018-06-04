<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use jlttt\watson\Frame\Frames;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    protected $frames;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I have no frame already registered
     */
    public function iHaveNoFrameAlreadyRegistered()
    {
        $this->frames = new Frames();
    }

    /**
     * @When I start a new frame
     */
    public function iStartANewFrame()
    {
        $this->frames->start();
    }

    /**
     * @Then I should have :arg1 frame registered
     */
    public function iShouldHaveFrameRegistered($arg1)
    {
        if (1 != $this->frames->count()) {
            throw new Exception("Not only one frame is in progress");
        }
    }

    /**
     * @Given I have a frame in progress for project :project
     */
    public function iHaveAFrameInProgressForProject($project)
    {
        $this->frames = new Frames();
        $this->frames->start($project);
    }

    /**
     * @When I start a new frame for project :project
     */
    public function iStartANewFrameForProject($project)
    {
        try {
            $this->frames->start($project);
        } catch (\Exception $e) {

        }
    }

    /**
     * @Then The running frame should be for project :project
     */
    public function TheRunningFrameShouldBeForProject($project)
    {
        if (!$this->frames->hasRunning()) {
            throw new Exception("No frame in progress");
        }
        $frame = $this->frames->getRunning();
        if ($project != $frame->getProject()) {
            throw new Exception("The running frame does not concern the project \"" . $project . "\"");
        }
    }

    /**
     * @When I stop the frame in progress
     */
    public function iStopTheFrameInProgress()
    {
        $this->frames->stop();
    }

    /**
     * @Then I should have no more running frame
     */
    public function iShouldHaveNoMoreRunningFrame()
    {
        if ($this->frames->hasRunning()) {
            throw new Exception("There is yet a frame in progress");
        }
    }

}
