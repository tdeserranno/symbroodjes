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

    /**
     * @var \Broodjes\BroodjesBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Broodjes\BroodjesBundle\Entity\User $user
     * @return BroodjesOrder
     */
    public function setUser(\Broodjes\BroodjesBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Broodjes\BroodjesBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
