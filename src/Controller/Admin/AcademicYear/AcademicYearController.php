<?php


namespace App\Controller\Admin\AcademicYear;


use App\Entity\AcademicYear;
use App\Form\Admin\School\AcademicYearType;
use App\Repository\AcademicYearRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AcademicYearController extends AbstractController
{
    /**
     * @var AcademicYearRepository
     */
    private $repository;


    /**
     * @var ObjectManager
     */
    private $em;


    public function __construct(AcademicYearRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/ecole/annees_academiques", name="admin.academicyear.index")
     * @return Response
     */

    public function index()
    {
        $years = $this->repository->findAll();
        $currentUser = $this->getUser();

        return $this->render('/admin/school/academicyear/index.html.twig', [
            'current_menu' => 'inscriptions',
            'current_user' => $currentUser,
            'years' => $years
        ]);
    }

    /**
     * @Route("/admin/ecole/annees_academiques/ajout", name="admin.academicyear.new")
     * @return Response
     */

    public function new(Request $request)
    {
        $academicYear = new AcademicYear();
        $form = $this->createForm(AcademicYearType::class, $academicYear);
        $form->handleRequest($request);
        $currentUser = $this->getUser();

        if($form->isSubmitted() && $form->isValid())
        {
            $year = $academicYear->getYear();
            $academicYear->setYear($year);

            $this->em->persist($academicYear);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle année académique a été ajoutée avec succès');
            return $this->redirectToRoute('admin.academicyear.index');
        }

        return $this->render('/admin/school/academicyear/new.html.twig', [
            'form' => $form->createView(),
            'current_user' => $currentUser,
            'current_menu' => 'inscriptions'
        ]);
    }

    /**
     *
     * @Route("/admin/ecole/inscriptions/annee/modifier/{id}", name="admin.academicyear.edit", methods="GET|POST")
     * @param AcademicYear $year
     * @return Response
     */
    public function edit(AcademicYear $year, Request $request)
    {
        $currentUser = $this->getUser();
        $form = $this->createForm(AcademicYearType::class, $year);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'L\' année académique a été éditée avec succès');
            return $this->redirectToRoute('admin.academicyear.index');
        }

        return $this->render('/admin/school/academicyear/edit.html.twig', [
            'year' => $year,
            'current_menu' => 'inscriptions',
            'form' => $form->createView(),
            'current_user' => $currentUser
        ]);
    }

}