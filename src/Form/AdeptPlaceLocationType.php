<?php

namespace App\Form;

use App\Entity\AdeptPlaceLocation;
use App\Form\DataTransformer\CommaToDotTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AdeptPlaceLocationType extends AbstractType
{
    private $transformer;

    public function __construct(CommaToDotTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required' => true
            ])
            ->add('url', TextareaType::class, [
                'label' => 'Lien vers Site Web',
                'required' => false
            ])
            ->add('distance', TextType::class, [
                'label' => 'Distance au Biéreau (Km)',
                'required' => true
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Nouvelle image',
                'delete_label' => false,
                'download_uri' => false,
                'download_link' => false,
                'required' => false,
                'imagine_pattern' => 'article_creation_preview',
            ])
        ;

        $builder->get('distance')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdeptPlaceLocation::class,
        ]);
    }
}
