<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\SchoolValue;
use App\Form\Admin\PageContent\SchoolValueFormType;
use App\Repository\SchoolValueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SchoolValuesController extends AbstractController
{
    /**
     * @var SchoolValueRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(SchoolValueRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/content/school_value/new", name="admin.content.school_value.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $current_user = $this->getUser();
        $value = new SchoolValue();

        $form = $this->createForm(SchoolValueFormType::class, $value);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($value);
            $this->em->flush();
            $this->addFlash('success', 'Un nouvel item a été ajouté aux valeurs de l\'école');
            return $this->redirectToRoute('admin.content.home_carousel', [
                'current_menu' => 'contenu'
            ]);
        }

        return $this->render('admin/content/school_values/new.html.twig', [
            'current_menu' => 'contenu',
            'current_user' => $current_user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/school_value/edit/{id}", name="admin.content.school_value.edit", methods="GET|POST")
     * @param SchoolValue $carousel
     * @return Response
     */
    public function edit(SchoolValue $value, Request $request)
    {
        $currentUser = $this->getUser();
        $form = $this->createForm(SchoolValueFormType::class, $value);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La valeur de l\'école a été modifiée');
            return $this->redirectToRoute('admin.content.home_carousel');
        }

        return $this->render('admin/content/school_values/edit.html.twig', [
            'value' => $value,
            'current_menu' => 'contenu',
            'form' => $form->createView(),
            'current_user' => $currentUser,
        ]);
    }

    /**
     * @Route("/admin/content/school_value/delete/{id}", name="admin.content.school_value.delete", methods="DELETE")
     * @param SchoolValue $value
     * @return Response
     */
    public function delete(SchoolValue $value, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $value->getID(), $request->get('_token')))
        {
            $this->em->remove($value);
            $this->em->flush();
            $this->addFlash('success', 'Elément supprimé de la bannière principale');
        }

        return $this->redirectToRoute('admin.content.home_carousel');
    }

}