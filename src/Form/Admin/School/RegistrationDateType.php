<?php

namespace App\Form\Admin\School;

use App\Entity\RegistrationDate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('regDate', DateType::class, [
                'label' => 'Date'
            ])
            ->add('enabled', ChoiceType::class, [
                'label' => 'Active',
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegistrationDate::class,
        ]);
    }
}
