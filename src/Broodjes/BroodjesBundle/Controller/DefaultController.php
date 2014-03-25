<?php

namespace Broodjes\BroodjesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BroodjesBundle:Default:index.html.twig', array('name' => $name));
    }
}
