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
        //retrieve order from session
//        $session = new Session();
//        $session->start();
        $session = $request->getSession();
        if (!empty($session->get('order'))) {
            $order = $session->get('order');
        } else {
            $order = new BroodjesOrder();
        }
        
        //create empty form & object for orderitem
        $orderItem = new OrderItem();
        $orderItemForm = $this->createForm(new OrderItemType(), $orderItem);
        
        //create order confirmation form
        $orderConfirmForm = $this->createForm(new OrderConfirmationType(), null, array(
            'action' => $this->generateUrl('broodjes_bestel_placeorder'),
        ));
        
        //handle forms, determine which was submitted and handle it 
        if ($request->getMethod() === 'POST') {
            if ($request->request->has('orderitem')) {
                //handle orderitem form
                $orderItemForm->handleRequest($request);
        
                //validate formdata
                 if ($orderItemForm->isValid()) {
                     //create object
                     $orderItem = $orderItemForm->getData();

                     //persist object in DB
         //            $em = $this->getDoctrine()->getManager();
         //            $em->persist($orderitem);
         //            $em->flush();

                     //set order on orderitem
                     $orderItem->setBroodjesorder($order);
                     
                     //add item to order
                     $order->addOrderitem($orderItem);
                     //set cart in session
                     $session->set('order', $order);

                     //redirect to self
                     return $this->redirect($this->generateUrl('broodjes_bestel'));
                 }
            }
            if ($request->request->has('orderconfirmation')) {
                //handle orderconfirmation form
                if ($orderConfirmForm->isValid()) {
                    return $this->redirect($this->generateUrl('broodjes_bestel_placeorder'));
                }
            }
        }
        
        //render page
        return $this->render('BroodjesBundle:Bestel:index.html.twig',
                array(
                    'orderform' => $orderItemForm->createView(),
                    'orderconfirmform' => $orderConfirmForm->createView(),
                    'order' => $order,
                ));
    }
    
    public function placeorderAction(Request $request)
    {
        //retrieve current shopping cart from session
        $session = $request->getSession();
        $order = $session->get('order');
        
        if (is_a($order, 'Broodjes\BroodjesBundle\Entity\BroodjesOrder') && !empty($order->getOrderItems())) {
            //build confirmation form
            $confirmForm = $this->get('form.factory')
                    ->createNamedBuilder('ordercomplete', 'form')
                    ->add('Bestelling voltooien', 'submit')
                    ->getForm();

            //handle form
            if ($request->request->has('ordercomplete')) {
                $confirmForm->handleRequest($request);
                //validate form
                if ($confirmForm->isValid()) {
                    //set order date
                    $order->setDate(new \DateTime());
                    //persist order
//                    echo 'PLACE DAMNIT';
                    $em = $this->getDoctrine()->getManager();
                    
                    //merge entity
//                    foreach ($order->getOrderitems() as $item) {  
//                        $em->merge($item->getBreadtype());
//                        foreach ($item->getToppings() as $topping) {
//                            $em->merge($topping);
//                        }
//                    }
                    $order = $em->merge($order);
                    
                    $em->persist($order);
                    $em->flush($order);
//                    var_dump($order);
//                    foreach ($order->getOrderitems() as $item) {
//                        var_dump($item);
//                        foreach ($item->getToppings() as $topping) {
//                            var_dump($topping);
//                        }
//                    }

                    
                    //clear session attribute
                    $session->remove('order');
                    
                    //redirect to home
                    return $this->redirect($this->generateUrl('broodjes_homepage'));
                }
            }
            
        } 
        
        
        
        //render page
        return $this->render('BroodjesBundle:Bestel:orderconfirmation.html.twig',
                array(
                    'order' => $order,
                    'form' => $confirmForm->createView(),
                ));
        
    }
}
