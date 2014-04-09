<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Broodjes\BroodjesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        //create empty form & object for orderitem
        $orderitem = new OrderItem();
        $form = $this->createForm(new OrderItemType(), $orderitem);
        
        //handle form submission
        $form->handleRequest($request);
        
       //validate formdata
        if ($form->isValid()) {
            //create object
            $orderitem = $form->getData();
            
            //persist object
            $em = $this->getDoctrine()->getManager();
            $em->persist($orderitem);
            $em->flush();
            //redirect to self
            return $this->redirect($this->generateUrl('broodjes_bestel'));
        }
        
        //render page
        return $this->render('BroodjesBundle:Bestel:index.html.twig',
                array(
                    'form' => $form->createView(),
                ));
    }
}
