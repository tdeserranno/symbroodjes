<?php

namespace Broodjes\BroodjesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of OrderType
 *
 * @author cyber01
 */
class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('breadtype', 'entity', array(
                    'class' => 'BroodjesBundle:BreadType',
                    'property' => 'description',
                    'expanded' => false,
                    'multiple' => false,))
                ->add('topping', 'entity', array(
                    'class' => 'BroodjesBundle:Topping', 
                    'property' => 'description',
                    'expanded' => true,
                    'multiple' => true,
                    ))
                ->add('quantity', 'integer')
                ->add('Toevoegen', 'submit');
    }
    
    public function getName()
    {
        return 'order';
    }
}
