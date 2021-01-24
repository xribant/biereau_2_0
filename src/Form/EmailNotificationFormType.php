<?php

namespace App\Form;

use App\Entity\EmailNotification;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailNotificationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom de la notification',
                'required' => true,
            ])
            ->add('fromAddress', EmailType::class, [
                'label' => 'Adresse expéditeur',
                'required' => true,
            ])
            ->add('toAddress', EmailType::class, [
                'label' => 'Envoyer une copie à',
            ])
            ->add('bodyText',CKEditorType::class, [
                'label' => 'Texte',
                'required' => true,
                'config' => [
                    'toolbar' => 'basic',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmailNotification::class,
        ]);
    }
}
