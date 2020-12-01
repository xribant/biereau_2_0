<?php

namespace App\Form\Admin\PageContent;

use App\Entity\SiteHomePageCarousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HomePageCarouselFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slogan', TextType::class, [
                'label' => 'Slogan (Max 255 caractères)',
                'required' => true,
            ])
            ->add('linkToMenu', TextType::class, [
                'label' => 'Lien vers contenu existant',
                'required' => false,
            ])
            ->add('backgroundImageFile', VichImageType::class, [
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
            'data_class' => SiteHomePageCarousel::class,
        ]);
    }
}
