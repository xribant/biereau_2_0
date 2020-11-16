<?php

namespace App\Form;

use App\Entity\BasicPage;
use App\Entity\NavMenu;
use App\Entity\SubMenu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BasicPageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la page',
                'required' => true,
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre de la page',
                'required' => true,
            ])
            ->add('bannerImageFile', FileType::class, [
                'label' => 'Image de bannière',
                'required' => false,
            ])
            ->add('parentNavMenu', EntityType::class, [
                'class' => NavMenu::class,
                'label' => 'Menu de Navigation Parent',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'required' => false,
            ])
            ->add('parentSubMenu', EntityType::class, [
                'class' => SubMenu::class,
                'label' => 'Sous-Menu Parent',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BasicPage::class,
        ]);
    }
}
