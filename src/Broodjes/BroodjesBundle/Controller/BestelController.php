<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Broodjes\BroodjesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of BestelController
 *
 * @author cyber01
 */
class BestelController extends Controller
{
    public function indexAction()
    {
        return $this->render('BroodjesBundle:Bestel:index.html.twig');
    }
}
