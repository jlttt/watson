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
        $this->frames->start("New Project");
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
}
