<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Broodjes\BroodjesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Broodjes\BroodjesBundle\Entity\OrderItem;
use Broodjes\BroodjesBundle\Entity\BroodjesOrder;
use Broodjes\BroodjesBundle\Form\Type\OrderItemType;
use Broodjes\BroodjesBundle\Form\Type\OrderConfirmationType;

/**
 * Description of BestelController
 *
 * @author cyber01
 */
class TestBestelController extends Controller
{
    public function indexAction()
    {
        //retrieve all breadtypes
        //build query
        $repository = $this->getDoctrine()->getRepository('BroodjesBundle:BreadType');
        $query = $repository->createQueryBuilder('bread')
                ->getQuery();
        //get breadtypes
        $breadtypes = $query->getResult();
        
        //build order
        $order = new BroodjesOrder();
        
        
        var_dump($order);
        
        //render page
        return $this->render('BroodjesBundle:Bestel:test.html.twig',
                array(
                    'breadtypes' => $breadtypes,
                ));
        
    }
}
