<?php

namespace Broodjes\BroodjesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItem
 */
class OrderItem
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $quantity;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * @var \Broodjes\BroodjesBundle\Entity\Breadtype
     */
    private $breadtype;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $toppings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->toppings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set breadtype
     *
     * @param \Broodjes\BroodjesBundle\Entity\Breadtype $breadtype
     * @return OrderItem
     */
    public function setBreadtype(\Broodjes\BroodjesBundle\Entity\Breadtype $breadtype = null)
    {
        $this->breadtype = $breadtype;

        return $this;
    }

    /**
     * Get breadtype
     *
     * @return \Broodjes\BroodjesBundle\Entity\Breadtype 
     */
    public function getBreadtype()
    {
        return $this->breadtype;
    }

    /**
     * Add toppings
     *
     * @param \Broodjes\BroodjesBundle\Entity\Topping $toppings
     * @return OrderItem
     */
    public function addTopping(\Broodjes\BroodjesBundle\Entity\Topping $toppings)
    {
        $this->toppings[] = $toppings;

        return $this;
    }

    /**
     * Remove toppings
     *
     * @param \Broodjes\BroodjesBundle\Entity\Topping $toppings
     */
    public function removeTopping(\Broodjes\BroodjesBundle\Entity\Topping $toppings)
    {
        $this->toppings->removeElement($toppings);
    }

    /**
     * Get toppings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getToppings()
    {
        return $this->toppings;
    }
    /**
     * @var \Broodjes\BroodjesBundle\Entity\BroodjesOrder
     */
    private $broodjesorder;


    /**
     * Set broodjesorder
     *
     * @param \Broodjes\BroodjesBundle\Entity\BroodjesOrder $broodjesorder
     * @return OrderItem
     */
    public function setBroodjesorder(\Broodjes\BroodjesBundle\Entity\BroodjesOrder $broodjesorder = null)
    {
        $this->broodjesorder = $broodjesorder;

        return $this;
    }

    /**
     * Get broodjesorder
     *
     * @return \Broodjes\BroodjesBundle\Entity\BroodjesOrder 
     */
    public function getBroodjesorder()
    {
        return $this->broodjesorder;
    }
    
    
    /**
     * Function that determines the actual cost of 1 sandwich
     */
    public function getUnitCost()
    {
        $cost = 0;
        $cost += $this->breadtype->getPrice();
        foreach ($this->toppings as $topping) {
            $cost += $topping->getPrice();
        }
        
        return $cost;
    }
    
    /**
     * Function that determines the total cost of a single orderitem
     */
    public function getTotalCost()
    {
        $cost = $this->getUnitCost();
        return $cost * $this->getQuantity();
    }
}
