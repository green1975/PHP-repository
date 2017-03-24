<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use blackknight467\StarRatingBundle\Form\RatingType as RatingType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('lastname')
        ->add('firstname')
        ->add('zipcode');

        $builder->add('rating', CollectionType::class, array(
            'entry_type' => RatinguserType::class,
            'allow_add'    => true,
        ))
        ->add('comments', CollectionType::class, array(
            'entry_type' => RatinguserType::class,
            'allow_add'    => true,
        ));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}