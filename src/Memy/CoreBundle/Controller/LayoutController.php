<?php

namespace Memy\CoreBundle\Controller;

class LayoutController extends BaseController
{
    public function indexAction()
    {
        return $this->render('MemyCoreBundle:Layout:index.html.twig', [
            'page_title' => "memy.tk - twój osobisty folder ze śmiesznymi obrazkami",
        ]);
    }
}
