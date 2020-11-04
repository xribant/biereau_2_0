<?php

namespace App\Form;

use App\Entity\AcademicYear;
use App\Entity\SchoolEntryDate;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolEntryDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entryDate', DateType::class, [
                'label' => 'Date'
            ])
            ->add('academicYear', EntityType::class, [
                'label' => 'Année Académique',
                'multiple' => false,
                'expanded' => false,
                'class' => AcademicYear::class,
                'choice_label' => 'year'
            ])
            ->add('enabled', ChoiceType::class, [
                'label' => 'Active',
                'multiple' => false,
                'expanded' => false,
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
            'data_class' => SchoolEntryDate::class,
            'translation_domain' =>'forms'
        ]);
    }
}
