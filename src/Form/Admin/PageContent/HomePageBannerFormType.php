<?php

namespace App\Form\Admin\PageContent;

use App\Entity\SiteHomePageBanner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomePageBannerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => true
            ])
            ->add('paragraph', TextareaType::class, [
                'require' => true,
                'label' => 'Texte à afficher'
            ])
            ->add('backgroundImageFile', FileType::class, [
                'label' => 'Image de fond',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SiteHomePageBanner::class,
        ]);
    }
}
