<?php

namespace App\Form;

use App\Entity\RegistrationContent;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationContentAlertFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('alert',CKEditorType::class, [
                'label' => 'Alerte',
                'required' => true,
                'config' => [
                    'toolbar' => 'basic',
                ]
            ])
            ->add('alertColor', ChoiceType::class, [
                'label' => 'Couleur de fond de la boîte d\'alerte',
                'choices' => [
                    'Bleu' => 'info',
                    'Rouge' => 'danger',
                    'Vert' => 'success',
                    'Jaune' => 'warning',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegistrationContent::class,
        ]);
    }
}
