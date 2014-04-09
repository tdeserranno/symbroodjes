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
use Broodjes\BroodjesBundle\Entity\BroodjesOrder;
use Broodjes\BroodjesBundle\Form\Type\BroodjesOrderType;
use Broodjes\BroodjesBundle\Entity\OrderItem;
use Broodjes\BroodjesBundle\Form\Type\OrderItemType;

/**
 * Description of BestelController
 *
 * @author cyber01
 */
class BestelController extends Controller
{
//    public function indexAction()
//    {
//        //retrieve all breadtypes
//        //build query
//        $repository = $this->getDoctrine()->getRepository('BroodjesBundle:BreadType');
//        $query = $repository->createQueryBuilder('bread')
//                ->getQuery();
//        //get breadtypes
//        $breadtypes = $query->getResult();
//        
//        
//        //render page
//        return $this->render('BroodjesBundle:Bestel:index.html.twig',
//                array(
//                    'breadtypes' => $breadtypes,
//                ));
//    }
    
    public function indexAction(Request $request)
    {
        //retrieve cart from session
//        $session = new Session();
//        $session->start();
        $session = $request->getSession();
        $cart = (!empty($session->get('cart'))) ? $session->get('cart') : array();
        
        //create empty form & object for orderitem
        $orderItem = new OrderItem();
        $form = $this->createForm(new OrderItemType(), $orderItem);
        
        //handle form submission
        $form->handleRequest($request);
        
       //validate formdata
        if ($form->isValid()) {
            //create object
            $orderItem = $form->getData();
            
            //persist object in DB
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($orderitem);
//            $em->flush();
            
            //persist object in cart
            array_push($cart, $orderItem);
            //persist cart in session
            $session->set('cart', $cart);
            
            
            //redirect to self
            return $this->redirect($this->generateUrl('broodjes_bestel'));
        }
        
        //render page
        return $this->render('BroodjesBundle:Bestel:index.html.twig',
                array(
                    'form' => $form->createView(),
                    'cart' => $cart,
                ));
    }
}
