<?php

namespace App\Form;

use App\Entity\NavMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NavMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('route', TextType::class, [
                'label' => 'Route',
                'required' => false,
            ])
            ->add('externalLink', ChoiceType::class, [
                'label' => 'Site externe',
                'expanded' => false,
                'multiple' => false,
                'choices' => [
                    'Non' => 0,
                    'Oui' => 1
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NavMenu::class,
        ]);
    }
}
