<?php

namespace App\Form;

use App\Entity\PreRegistration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentFirstName', TextType::class)
            ->add('parentLastName', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', TextType::class)
            ->add('childFirstName', TextType::class)
            ->add('childLastName', TextType::class)
            ->add('childBirthDate', DateType::class)
            ->add('childEntryDate', DateType::class)
            ->add('childSection', ChoiceType::class)
            ->add('registrationSession', ChoiceType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PreRegistration::class,
        ]);
    }
}
