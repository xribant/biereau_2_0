<?php


namespace App\Form\Admin\School;


use App\Entity\AcademicYear;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AcademicYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', TextType::class, [
                'label' => 'Année'
            ])
            ->add('activeForRegistration', ChoiceType::class, [
                'label' => 'Ouverte aux inscriptions',
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    'Non' => 0,
                    'Oui' => 1
                ]
            ])
            ->add('startRegistrationDate', DateTimeType::class, [
                'label' => 'Début des inscriptions'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AcademicYear::class,
            'translation_domain' => 'forms'
        ]);
    }
}

