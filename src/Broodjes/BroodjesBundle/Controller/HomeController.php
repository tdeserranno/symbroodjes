<?php

namespace Broodjes\BroodjesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of HomeController
 *
 * @author Thomas Deserranno
 */
class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('BroodjesBundle:Home:index.html.twig');
    }
}
