<?php

namespace App\Form;

use App\Entity\BasicPage;
use App\Entity\NavMenu;
use App\Entity\SubArticle;
use App\Entity\SubMenu;
use App\Repository\NavMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BasicPageFormType extends AbstractType
{
    private $em;
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;

    /**
     * The Type requires the EntityManager as argument in the constructor. It is autowired
     * in Symfony 3.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em, NavMenuRepository $navMenuRepository)
    {
        $this->em = $em;
        $this->navMenuRepository = $navMenuRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la page',
                'required' => true,
            ])
            ->add('bannerImageFile', VichImageType::class, [
                'label' => 'Nouvelle image',
                'delete_label' => false,
                'download_uri' => false,
                'download_link' => false,
                'required' => false,
                'imagine_pattern' => 'article_creation_preview',
            ])
            ->add('parentNavMenu', EntityType::class, [
                'class' => NavMenu::class,
                'placeholder' => 'Menu de navigation',
                'label' => 'Menu de Navigation Parent',
                'required' => false,
                'choice_label' => 'name',
            ])
            ->add('parentSubMenu', EntityType::class, [
                'class' => SubMenu::class,
                'label' => 'Sous-Menu Parent',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'required' => false,
            ]);
    }

        /*
                $builder->get('parentNavMenu')->addEventListener(
                    FormEvents::POST_SUBMIT,
                    function(FormEvent $event) {
                        $navMenu = $event->getForm()->getData();
                        $form = $event->getForm();
                        $this->addSubMenuField($form->getParent(), $form->getData());
                    }
                );
                $builder->addEventListener(
                    FormEvents::POST_SET_DATA,
                    function(FormEvent $event) {
                        $data = $event->getData();
                        @var $subMenu SubMenu
                $subMenu = $data->getParentSubMenu();
                if($subMenu){
                    $navMenu = $subMenu->getParentMenu();
                    $form = $event->getForm();
                    $this->addSubMenuField($form, $navMenu);
                    $form->get('parentNavMenu')->setData($navMenu);
                }
            }
        );
    private function addSubMenuField(FormInterface $form, ?NavMenu $navMenu){
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'parentSubMenu',
            EntityType::class,
            null,
            [
                'class' => SubMenu::class,
                'placeholder' => $navMenu ? 'Sous-Menu' : 'Sélectionnez un menu principal',
                'required' => false,
                'choice_label' => 'name',
                'auto_initialize' => false,
                'choices' => $navMenu ? $navMenu->getSubMenus() : []
            ]
        );
        $form->add($builder->getForm());


            /* ->add('parentNavMenu', EntityType::class, [
                'class' => NavMenu::class,
                'label' => 'Menu de Navigation Parent',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'required' => false,
            ])
            ->add('parentSubMenu', EntityType::class, [
                'class' => SubMenu::class,
                'disabled' => true,
                'label' => 'Sous-Menu Parent',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'required' => false,
            ])
        ; */

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BasicPage::class,
        ]);
    }
}
