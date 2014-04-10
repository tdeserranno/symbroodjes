<?php

namespace Broodjes\BroodjesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of OrderType
 *
 * @author cyber01
 */
class OrderItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('breadtype', 'entity', array(
                    'class' => 'BroodjesBundle:BreadType',
                    'property' => 'choicedescription',
                    'expanded' => false,
                    'multiple' => false,))
                ->add('toppings', 'entity', array(
                    'class' => 'BroodjesBundle:Topping', 
                    'property' => 'choicedescription',
                    'expanded' => true,
                    'multiple' => true,
                    ))
                ->add('quantity', 'integer')
                ->add('Toevoegen', 'submit');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Broodjes\BroodjesBundle\Entity\OrderItem',
        ));
    }
    
    public function getName()
    {
        return 'orderitem';
    }
}
