<?php

namespace App\Form;

use App\Entity\ContactSub;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactSubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentFirstName', TextType::class, [
                'label' => false
            ])
            ->add('parentLastName', TextType::class, [
                'label' => false
            ])
            ->add('parentPhone', TextType::class, [
                'label' => false
            ])
            ->add('parentEmail', TextType::class, [
                'label' => false
            ])
            ->add('childFirstName', TextType::class, [
                'label' => false
            ])
            ->add('childLastName', TextType::class, [
                'label' => false
            ])
            ->add('childBirthDate',DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
                    'placeholder' => 'Date de naissance'
                ],
                'html5' => false
            ])
            ->add('childEntryDate', ChoiceType::class, [
                'label' => false
            ])
            ->add('childSection', ChoiceType::class, [
                'label' => false
            ])
            ->add('sessionDate', ChoiceType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactSub::class,
        ]);
    }
}
