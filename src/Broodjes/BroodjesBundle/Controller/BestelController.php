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
    public function indexAction(Request $request)
    {
        //enable session
        $session = $request->getSession();
        
        //perform timecheck
        if ($this->get('broodjesUtils')->timeCheck()) {
            //perform order for the day check
            //check DB for order for current user for current date
            $user = $this->get('security.context')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();
            $orders = $em->getRepository('BroodjesBundle:BroodjesOrder')
                    ->findTodayByUser($user);
            //test if orders were found
            if (empty($orders)) {
                //generate order page
                //retrieve order from session
                if (!empty($session->get('order'))) {
                    $order = $session->get('order');
                } else {
                    $order = new BroodjesOrder();
                }

                //flash time notice
                $flashMessage = $this->get('broodjesUtils')->timeNotice();
                if ($flashMessage !== null) {
                    $session->getFlashBag()->set(
                        'notice', $flashMessage);
                } 

                //create empty form & object for orderitem
                $orderItem = new OrderItem();
                $orderItemForm = $this->createForm(new OrderItemType(), $orderItem);

                //create order confirmation form
                $orderConfirmForm = $this->createForm(new OrderConfirmationType(), null, array(
                    'action' => $this->generateUrl('broodjes_bestel_placeorder'),
                ));

                //handle forms, determine which was submitted and handle it
                //source: http://www.craftitonline.com/2011/06/symfony2-multiple-forms-different-from-embedded-forms/
                if ($request->getMethod() === 'POST') {
                    if ($request->request->has('orderitem')) {
                        //handle orderitem form
                        $orderItemForm->handleRequest($request);

                        //validate formdata
                         if ($orderItemForm->isValid()) {
                             //get object from formdata
                             $orderItem = $orderItemForm->getData();
                             //set order on orderitem (for correct bidirectional association)
                             $orderItem->setBroodjesorder($order);
                             //check if new item exists in order
                             $existingItem = $this->get('broodjesUtils')->itemExists($order, $orderItem);
                             var_dump($existingItem);
                             if ($existingItem === false) {
                                 //add item to order
                                 $order->addOrderitem($orderItem);
                             } else {
                                 //increment quantity of existing item
                                 $orderItems = $order->getOrderitems();
                                 $quantity = $orderItems[$existingItem]->getQuantity() + $orderItem->getQuantity();
                                 $orderItems[$existingItem]->setQuantity($quantity);
                             }
                             
                             //set cart in session
                             $session->set('order', $order);

                             //redirect to self
//                             return $this->redirect($this->generateUrl('broodjes_bestel'));
                         }
                    }
                    if ($request->request->has('orderconfirmation')) {
                        //handle orderconfirmation form
                        if ($orderConfirmForm->isValid()) {
                            //redirect to confirmation page
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
            } else {
                $order = $orders[0];
                //generate flash message
                $session->getFlashBag()->set('notice', 'U heeft vandaag al een bestelling geplaatst');
                //render orderhistory page
                return $this->render('BroodjesBundle:Bestel:orderhistory.html.twig', array(
                    'order' => $order,
                ));
            }
        } else {
            //display flash message on orderhistory page
            //generate flash message
            $session->getFlashBag()->set('notice', 'U kan vandaag geen broodjes meer bestellen.');
            
            //render page
            return $this->render('BroodjesBundle:Bestel:orderhistory.html.twig');
        }

       
    }
    
    public function placeorderAction(Request $request)
    {
        //perform time check
        if ($this->get('broodjesUtils')->timeCheck()) {
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
                        //get user
                        $usr= $this->get('security.context')->getToken()->getUser();
                        //set user on order (for correct association)
                        $order->setUser($usr);
                        
                        //set order date
                        $order->setDate(new \DateTime());
                        
                        //persist order
                        $em = $this->getDoctrine()->getManager();
                        //merge unmanaged order entity with current Entity Manager
                        $order = $em->merge($order);
                        $em->persist($order);
                        $em->flush($order);

                        //clear session attribute
                        $session->remove('order');

                        //flash success message
                        $session->getFlashBag()->set('ordersuccess', 'Uw order werd met success geplaatst');

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
        } else {
            //display flash message on orderhistory page
            //generate flash message
            $session->getFlashBag()->set('notice', 'U kan vandaag geen broodjes meer bestellen.');
            
            //render page
            return $this->render('BroodjesBundle:Bestel:orderhistory.html.twig');
        }
    }
}
