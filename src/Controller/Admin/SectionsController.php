<?php

namespace App\Controller\Admin;

use App\Entity\SchoolSection;
use App\Form\SchoolSectionType;
use App\Repository\SchoolSectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SectionsController extends AbstractController
{
    /**
     * @var SchoolSectionRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(SchoolSectionRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/school/sections", name="admin.sections")
     * @return Response
     */
    public function index()
    {
        $sections = $this->repository->findAll();
        return $this->render('/admin/school/sections/index.html.twig', [
            'sections' => $sections
        ]);
    }

    /**
     * @Route("/admin/school/sections/new", name="admin.sections.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $section = new SchoolSection();
        $form = $this->createForm(SchoolSectionType::class, $section);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($section);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle section a été ajoutée avec succès');
            return $this->redirectToRoute('admin.sections');
        }

        return $this->render('/admin/school/sections/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/admin/school/sections/{id}", name="admin.sections.edit", methods="GET|POST")
     * @param SchoolSection $section
     * @return Response
     */
    public function edit(SchoolSection $section, Request $request)
    {
        $form = $this->createForm(SchoolSectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La section a été éditée avec succès');
            return $this->redirectToRoute('admin.sections');
        }

        return $this->render('admin/school/sections/edit.html.twig', [
            'section' => $section,
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/admin/school/sections/{id}", name="admin.sections.delete", methods="DELETE")
     * @param SchoolSection $section
     * @return Response
     */
    public function delete(SchoolSection $section, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $section->getID(), $request->get('_token')))
        {
            $this->em->remove($section);
            $this->em->flush();
            $this->addFlash('success', 'Section supprimée avec succès');
        }

        return $this->redirectToRoute('admin.sections');
    }


}