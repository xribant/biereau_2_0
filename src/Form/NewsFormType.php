<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre (max 255 Caractères)',
                'required' => false,
            ])
            ->add('article', TextareaType::class, [
                'label' => 'Texte',
                'required' => true,
                'attr' => [
                    'rows' => 10,
                ]
            ])
            ->add('author', TextType::class, [
                'label' => 'Initiateur',
                'required' => true,
            ])
            ->add('job', TextType::class, [
                'label' => 'Fonction',
                'required' => false,
            ])
            ->add('url', TextType::class, [
                'required' => false,
                'label' => 'Adresse Web'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
