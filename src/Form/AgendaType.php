<?php

namespace App\Form;

use App\DataTransformer\TextToDatetimeDataTransformer;
use App\Entity\Agenda;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('begin_at',DateTimeType::class, [
                'label' => 'Début',
                'required' => true,
                'data' => new \DateTime(),
                'error_bubbling' => true,
            ])
            ->add('end_at',DateTimeType::class, [
                'label' => 'Fin',
                'required' => true,
                'data' => new \DateTime(),
                'error_bubbling' => true,
            ])
            ->add('title',TextType::class, [
                'label' => 'Titre',
                'required' => true,
            ])
            ->add('location',TextType::class, [
                'label' => 'Localisation',
                'required' => false,
            ])
            ->add('description',CKEditorType::class, [
                'label' => false,
                'required' => true,
                'config' => [
                    'toolbar' => 'basic',
                ]
            ])
            ->add('click', ChoiceType::class, [
                'label' => 'Afficher détails sur la page agenda',
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agenda::class,
        ]);
    }
}
