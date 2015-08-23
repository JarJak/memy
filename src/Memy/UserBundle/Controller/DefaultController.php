<?php

namespace Memy\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MemyUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
