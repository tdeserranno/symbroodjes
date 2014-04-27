<?php

namespace Broodjes\BroodjesBundle\DependencyInjection;

/**
 * Description of BroodjesUtils
 * 
 * Helper functions for BroodjesBundle. Load class as a service.
 * In a controller use $this->get('broodjesUtils') to get the class.
 * So $this->get('broodjesUtils')->timeCheck() runs the timeCheck function.
 *
 * @author cyber01
 */
class BroodjesUtils
{

    private $param1; //maxOrderHours
    private $param2; //maxOrderMinutes
    private $param3; //maxOrderNoticeMinutes

    function __construct($param1, $param2, $param3)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
    }

    /*
     * Checks if current time is approaching the max order time.
     * Max orderhours and minutes and the warning interval (in minutes) is set
     * using parameters in BroodjesBundle\Resources\config\services.yml
     */

    function timeNotice()
    {
        $message = null;
        $maxTime = mktime($this->param1, $this->param2, 0);
        $currentTime = time();
        $noticeTimeDelta = $this->param3 * 60;
        if (($maxTime - $currentTime) < $noticeTimeDelta) {
            $current = new \DateTime();
            $current->setTimestamp($currentTime);
            $minutes = ($this->param2 != 0) ? $this->param2 : '';
            $message = 'Broodjes bestellen kan tot ' . $this->param1
                    . 'u' . $minutes . '. Het is nu ' . $current->format('H:i:s');
        }
        return $message;
    }

    /**
     * Checks if current time has passed the max order time 
     * @return boolean
     */
    function timeCheck()
    {
        $maxTime = mktime($this->param1, $this->param2, 0);
        $currentTime = time();
        if ($currentTime >= $maxTime) {
            return false;
        } else {
            return true;
        }
    }

    function itemExists($order, $newOrderItem)
    {
        $itemfound = false;
        //check if order is empty
        if (!empty($order->getOrderItems())) {
            //check each item in order
            foreach ($order->getOrderItems() as $orderItem) {
                //check if breadtype is the same
                if ($orderItem->getBreadtype() == $newOrderItem->getBreadType()) {
                    //get toppingids of items to compare
                    $arrOrderItemToppingIds = array();
                    $arrNewOrderItemToppingIds = array();
                    foreach ($orderItem->getToppings() as $topping) {
                        array_push($arrOrderItemToppingIds, $topping->getId());
                    }
                    foreach ($newOrderItem->getToppings() as $topping) {
                        array_push($arrNewOrderItemToppingIds, $topping->getId());
                    }
                    $difference = array_diff($arrOrderItemToppingIds, $arrNewOrderItemToppingIds);
                    $differenceNew = array_diff($arrNewOrderItemToppingIds, $arrOrderItemToppingIds);
                    $difference = array_merge($difference, $differenceNew);
                    
                    if (empty($difference)) {
                        return $order->getOrderItems()->indexOf($orderItem);
                    }
                }
            }
        }
        return $itemfound;
    }

}
