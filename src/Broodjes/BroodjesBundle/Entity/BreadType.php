<?php

namespace Broodjes\BroodjesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BreadType
 */
class BreadType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $price;


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
     * Set description
     *
     * @param string $description
     * @return BreadType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return BreadType
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Function that returns string combining description and price
     * To be used for displaying during order process
     */
    public function getChoiceDescription()
    {
        return sprintf('%s - %s€', $this->description, $this->price);
    }
}
