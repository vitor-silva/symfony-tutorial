<?php

/**
 * Created by PhpStorm.
 * User: vs
 * Date: 06/08/15
 * Time: 15:57
 */
namespace Yoda\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text')
            ->add('email', 'email', array(
                'required' => false,
                'label' => 'Email Address',
                'attr' => array('class' => 'C-3PO')
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Yoda\UserBundle\Entity\User',
        ));
    }


    public function getName()
    {
        return 'user_register';
    }


}