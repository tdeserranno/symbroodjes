<?php

namespace Broodjes\BroodjesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of OrderType
 *
 * @author cyber01
 */
class OrderConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Bestelling bevestigen', 'submit');
    }
    
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'Broodjes\BroodjesBundle\Entity\OrderItem',
//        ));
//    }
    
    public function getName()
    {
        return 'orderconfirmation';
    }
}
