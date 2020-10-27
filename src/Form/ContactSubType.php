<?php

namespace App\Form;

use App\Entity\ContactSub;
use App\Entity\RegistrationDate;
use App\Entity\SchoolEntryDate;
use App\Entity\SchoolSection;
use App\Form\DataTransformer\StringToDatetimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                'label' => false,
                'required' => false
            ])
            ->add('parentEmail', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('childFirstName', TextType::class, [
                'label' => false
            ])
            ->add('childLastName', TextType::class, [
                'label' => false
            ])
            ->add('childBirthDate', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'd-M-y',
                'input' => 'datetime',
                'attr' => [
                    'class' => 'js-datepicker',
                    'placeholder' => 'Date de naissance'
                ]
            ])
          ->add('childEntryDate', EntityType::class, [
                 'label' => false,
                 'multiple' => false,
                 'expanded' => false,
                 'placeholder' => 'Date d\'entrée à l\'école',
                 'class' => SchoolEntryDate::class,
                 'choice_label' => 'textDate'
            ])
           ->add('childSection', EntityType::class, [
                 'label' => false,
                 'multiple' => false,
                 'expanded' => false,
                 'placeholder' => 'Section',
                 'class' => SchoolSection::class,
                 'choice_label' => 'sectionFullName'
            ])
         ->add('sessionDate', EntityType::class, [
             'label' => false,
             'multiple' => false,
             'expanded' => false,
             'placeholder' => 'Séance d\'info',
             'class' => RegistrationDate::class,
             'choice_label' => 'textDate'
         ]);

        $builder->get('childEntryDate')
            ->addModelTransformer(new StringToDatetimeTransformer());

        $builder->get('sessionDate')
            ->addModelTransformer(new StringToDatetimeTransformer());

        $builder->get('childSection')
            ->addModelTransformer(new StringToDatetimeTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactSub::class,
            'attr' => ['autocomplete' => 'off']
        ]);
    }
}
