<?php

namespace App\Form;

use App\Entity\PreRegistration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentFirstName')
            ->add('parentLastName')
            ->add('phone')
            ->add('email')
            ->add('childFirstName')
            ->add('childLastName')
            ->add('childBirthDate')
            ->add('childEntryDate')
            ->add('childSection')
            ->add('registrationSession')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PreRegistration::class,
        ]);
    }
}
