<?php

namespace Broodjes\BroodjesBundle\Fixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Broodjes\BroodjesBundle\Entity\BreadType;

/**
 * Description of BreadTypeFixtures
 *
 * @author cyber01
 */
class BreadTypeFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bread1 = new BreadType();
        $bread1->setDescription('wit');
        $bread1->setPrice(1.00);
        $manager->persist($bread1);
        $this->addReference('breadtype1', $bread1);
        
        $bread2 = new BreadType();
        $bread2->setDescription('bruin');
        $bread2->setPrice(1.30);
        $manager->persist($bread2);
        $this->addReference('breadtype2', $bread2);
        
        $bread3 = new BreadType();
        $bread3->setDescription('fitness');
        $bread3->setPrice(1.30);
        $manager->persist($bread3);
        $this->addReference('breadtype3', $bread3);
        
        $bread4 = new BreadType();
        $bread4->setDescription('ciabatta');
        $bread4->setPrice(1.50);
        $manager->persist($bread4);
        $this->addReference('breadtype4', $bread4);
        
        $bread5 = new BreadType();
        $bread5->setDescription('waldkorn');
        $bread5->setPrice(1.50);
        $manager->persist($bread5);
        $this->addReference('breadtype5', $bread5);
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}
