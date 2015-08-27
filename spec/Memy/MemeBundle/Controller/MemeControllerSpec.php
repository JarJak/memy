<?php

namespace spec\Memy\MemeBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MemeControllerSpec extends ObjectBehavior
{
    function it_is_of_happenings()
    {
        $this->shouldHaveType('Memy\MemeBundle\Controller\MemeController');
        $this->listAction(new \Symfony\Component\HttpFoundation\Request())->shouldReturn('Symfony\Component\HttpFoundation\Response');
    }
}
