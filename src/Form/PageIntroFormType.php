<?php

namespace App\Form;

use App\Entity\BasicPage;
use App\Entity\Pageintro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PageIntroFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => true,
            ])
            ->add('subTitle', TextType::class, [
                'label' => 'Sous-Titre',
                'required' => false,
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Texte',
                'required' => true,
                'attr' => [
                    'rows' => 10,
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Nouvelle image',
                'delete_label' => false,
                'download_uri' => false,
                'download_link' => false,
                'required' => false,
                'imagine_pattern' => 'article_creation_preview',
            ])
            ->add('parentPage', EntityType::class, [
                'class' => BasicPage::class,
                'label' => 'Page',
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'title'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pageintro::class,
        ]);
    }
}
