<?php

namespace Broodjes\BroodjesBundle\Fixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Broodjes\BroodjesBundle\Entity\Topping;

/**
 * Description of BreadTypeFixtures
 *
 * @author cyber01
 */
class ToppingFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $topping1 = new Topping();
        $topping1->setDescription('kaas');
        $topping1->setPrice(0.30);
        $manager->persist($topping1);
        $this->addReference('topping1', $topping1);
        
        $topping2 = new Topping();
        $topping2->setDescription('ham');
        $topping2->setPrice(0.50);
        $manager->persist($topping2);
        $this->addReference('topping2', $topping2);
        
        $topping3 = new Topping();
        $topping3->setDescription('sla');
        $topping3->setPrice(0.15);
        $manager->persist($topping3);
        $this->addReference('topping3', $topping3);
        
        $topping4 = new Topping();
        $topping4->setDescription('tomaat');
        $topping4->setPrice(0.15);
        $manager->persist($topping4);
        $this->addReference('topping4', $topping4);
        
        $topping5 = new Topping();
        $topping5->setDescription('wortel(geraspt)');
        $topping5->setPrice(0.15);
        $manager->persist($topping5);
        $this->addReference('topping5', $topping5);
        
        $topping6 = new Topping();
        $topping6->setDescription('hardgekookt ei(schijfjes)');
        $topping6->setPrice(0.15);
        $manager->persist($topping6);
        $this->addReference('topping6', $topping6);
                
        $topping7 = new Topping();
        $topping7->setDescription('mayonaise');
        $topping7->setPrice(0.10);
        $manager->persist($topping7);
        $this->addReference('topping7', $topping7);
                
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}
