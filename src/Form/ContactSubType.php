<?php

namespace App\Form;

use App\Entity\ContactSub;
use App\Entity\RegistrationDate;
use App\Entity\SchoolEntryDate;
use App\Entity\SchoolSection;
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
            ->add('childEntryDate', EntityType::class, [
                'label' => false,
                'placeholder' => 'Date d\'entrée à l\'école',
                'class' => SchoolEntryDate::class,
                'choice_label' => function(SchoolEntryDate $entryDate) {
                    return ($entryDate->getEntryDate())->format("d-M-Y");
                }
            ])
            ->add('childSection', EntityType::class,[
                'label' => false,
                'placeholder' => 'Section',
                'class' => SchoolSection::class,
                'choice_label' => 'sectionFullName'
            ])
            ->add('sessionDate', EntityType::class,[
                'label' => false,
                'placeholder' => 'Séance d\'info',
                'class' => RegistrationDate::class,
                'choice_label' => function(RegistrationDate $regDate) {
                    return ($regDate->getRegDate())->format("d-m-Y");
                }
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
