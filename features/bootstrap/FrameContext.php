<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use jlttt\watson\Clock\ManageableClock;
use jlttt\watson\Clock\SystemClock;
use jlttt\watson\Frame\Frames;
/**
 * Defines application features from the specific context.
 */
class FrameContext implements Context
{
    protected $frames;
    protected $lastEndedFrame;
    protected $clock;
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
        $this->frames = new Frames(new SystemClock());
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
        $this->frames = new Frames(new SystemClock());
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
        $this->lastEndedFrame = $this->frames->stop();
    }

    /**
     * @Then I should have no more running frame
     */
    public function iShouldHaveNoMoreRunningFrame()
    {
        if ($this->frames->hasRunning()) {
            throw new Exception("There is already a frame in progress");
        }
    }

    /**
     * @Given I have a frame in progress for project :project started at :time
     */
    public function iHaveAFrameInProgressForProjectStartedAt($project, $time)
    {
        $this->clock = new ManageableClock();
        $this->clock->freezeAt($time);
        $this->frames = new Frames($this->clock);
        $this->frames->start($project);
    }

    /**
     * @When I stop the frame at :time
     */
    public function iStopTheFrameAt($time)
    {
        $this->clock->freezeAt($time);
        $this->lastEndedFrame = $this->frames->stop();
    }

    /**
     * @Then The just ended frame should have a duration of :duration
     */
    public function theJustEndedFrameShouldHaveADurationOf($duration)
    {
        if ($this->lastEndedFrame->getDuration() != $duration) {
            throw new Exception("The frame duration is wrong");
        }
    }


}
