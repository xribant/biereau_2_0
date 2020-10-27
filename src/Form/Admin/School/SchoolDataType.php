<?php

namespace App\Form\Admin\School;

use App\Entity\SchoolData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'value' => 'Collège du Biéreau',
                    'class' => 'form-control'
                ]
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue',
                'attr' => [
                    'value' => 'Rue du collège',
                    'class' => 'form-control'
                ]
            ])
            ->add('streetNum', TextType::class, [
                'label' => 'N°',
                'attr' => [
                    'value' => '2',
                    'class' => 'form-control'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code Postal',
                'attr' => [
                    'value' => '1348',
                    'class' => 'form-control'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Localité',
                'attr' => [
                    'value' => 'Ottignies-Louvain-La-Neuve',
                    'class' => 'form-control'
                ]
            ])
            ->add('phone1', TextType::class, [
                'label' => 'Téléphone 1',
                'attr' => [
                    'value' => '010.45.03.06',
                    'class' => 'form-control'
                ]
            ])
            ->add('phone2', TextType::class, [
                'label' => 'Téléphone 2',
                'required' => false,
                'attr' => [
                    'value' => '',
                    'class' => 'form-control'
                ]
            ])
            ->add('email1', TextType::class, [
                'label' => 'E-Mail 1',
                'attr' => [
                    'value' => 'direction@biereau.be',
                    'class' => 'form-control'
                ]
            ])
            ->add('email2', TextType::class, [
                'label' => 'E-Mail 2',
                'required' => false,
                'attr' => [
                    'value' => 'secretariat@biereau.be',
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SchoolData::class,
        ]);
    }
}
