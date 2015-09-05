<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class ApplicationContext extends MinkContext implements Context, SnippetAcceptingContext
{
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
     * @Given I am a guest user
     */
    public function iAmAGuestUser()
    {
        // auth code goes here
        //throw new PendingException();
    }

    /**
     * This hook should be placed in all contexts to allow easy debug on Travis CI
     * @AfterStep
     * @param AfterStepScope $event
     */
    public function outputHtmlAfterFailedStep(AfterStepScope $event)
    {
        if (!$event->getTestResult()->isPassed()) {
            if ($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
                var_dump($this->getSession()->getCurrentUrl());
                var_dump($this->getSession()->getPage()->getHtml());
            }
        }
    }

}
