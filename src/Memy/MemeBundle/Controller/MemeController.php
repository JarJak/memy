<?php

namespace Memy\MemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MemeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MemyMemeBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function addAction($name)
    {
        return $this->render('MemyMemeBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function randomAction($name)
    {
        return $this->render('MemyMemeBundle:Default:index.html.twig', array('name' => $name));
    }
}
