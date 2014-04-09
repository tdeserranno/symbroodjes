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
class BroodjesOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('orderitems', 'collection', array(
                    'type' => new OrderItemType(),
                    'allow_add' => true,
                ))
                ->add('Bestellen', 'submit');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Broodjes\BroodjesBundle\Entity\BroodjesOrder',
        ));
    }
    
    public function getName()
    {
        return 'broodjesorder';
    }
}
