<?php

namespace App\Form;

use App\Entity\AdeptCycle;
use App\Entity\AdeptCycleKm;
use App\Form\DataTransformer\CommaToDotTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdeptCycleKmType extends AbstractType
{
    private $transformer;

    public function __construct(CommaToDotTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('distance', TextType::class, [
                'label' => 'Distance parcourue (Km)',
                'required' => true
            ])
            ->add('walked_at', DateType::class, [
                'label' => 'Date du parcour',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'd-M-y',
                'input' => 'datetime',
                'required' => false,
                'attr' => [
                    'class' => 'js-datepicker'
                ]
            ])
            ->add('cycle', EntityType::class, [
                'label' => 'Cycle',
                'class' => AdeptCycle::class,
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
        ;

        $builder->get('distance')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdeptCycleKm::class,
        ]);
    }
}
