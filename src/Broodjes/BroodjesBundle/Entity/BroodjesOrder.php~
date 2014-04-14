<?php

namespace Broodjes\BroodjesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BroodjesOrder
 */
class BroodjesOrder
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;


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
     * Set date
     *
     * @param \DateTime $date
     * @return BroodjesOrder
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orderitems;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderitems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add orderitems
     *
     * @param \Broodjes\BroodjesBundle\Entity\OrderItem $orderitems
     * @return BroodjesOrder
     */
    public function addOrderitem(\Broodjes\BroodjesBundle\Entity\OrderItem $orderitems)
    {
        $this->orderitems[] = $orderitems;

        return $this;
    }

    /**
     * Remove orderitems
     *
     * @param \Broodjes\BroodjesBundle\Entity\OrderItem $orderitems
     */
    public function removeOrderitem(\Broodjes\BroodjesBundle\Entity\OrderItem $orderitems)
    {
        $this->orderitems->removeElement($orderitems);
    }

    /**
     * Get orderitems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderitems()
    {
        return $this->orderitems;
    }
}
