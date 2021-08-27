<?php

namespace App\Form\Admin\Page;

use App\Entity\BasePage;
use App\Entity\NavMenu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BasePageFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => true,
            ])
            ->add('menuItem', EntityType::class, [
                'class' => NavMenu::class,
                'label' => 'Menu',
                'placeholder' => 'Nouveau',
                'multiple' => false,
                'expanded' => false,
                'choice_label' => 'name',
            ])
            ->add('bannerImageFile', VichImageType::class, [
                'label' => 'Nouvelle image',
                'delete_label' => false,
                'download_uri' => false,
                'download_link' => false,
                'required' => false,
                'imagine_pattern' => 'article_creation_preview',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BasePage::class,
        ]);
    }
}
