<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\BasicPage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleFormType extends AbstractType
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
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('subTitle', TextType::class, [
                'label' => 'Sous-Titre',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Contenu',
                'required' => true,
                'attr' => [
                    'rows' => 10,
                    'cols' => 40,
                    'class' => 'form-control',
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
                'label' => 'Page',
                'class' => BasicPage::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
