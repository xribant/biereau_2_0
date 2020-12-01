<?php

namespace App\Form;

use App\Entity\NavMenu;
use App\Entity\SubMenu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubMenuType extends AbstractType
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
                'required' => true,
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
            ->add('parentMenu', EntityType::class, [
                'class' => NavMenu::class,
                'label' => 'Menu Parent',
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'name',
            ])
            ->add('position', TextType::class, [
                'label' => 'Position',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SubMenu::class,
        ]);
    }
}
