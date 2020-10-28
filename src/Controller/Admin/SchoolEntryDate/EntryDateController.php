<?php

namespace App\Controller\Admin\SchoolEntryDate;

use App\Entity\SchoolEntryDate;
use App\Form\SchoolEntryDateType;
use App\Repository\SchoolEntryDateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntryDateController extends AbstractController
{
    /**
     * @var SchoolEntryDateRepository
     */
    private $repository;


    /**
     * @var ObjectManager
     */
    private $em;


    public function __construct(SchoolEntryDateRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/school/entrydate", name="admin.entrydate.index")
     * @return Response
     */

    public function index()
    {
        $dates = $this->repository->findAll();
        $user = $this->getUser();

        return $this->render('/admin/school/entrydate/index.html.twig', [
            'current_menu' => 'schoolData',
            'user' => $user,
            'dates' => $dates
        ]);
    }

    /**
     * @Route("/admin/school/entrydate/new", name="admin.entrydate.new")
     * @return Response
     */

    public function new(Request $request)
    {
        $entryDate = new SchoolEntryDate();
        $form = $this->createForm(SchoolEntryDateType::class, $entryDate);
        $form->handleRequest($request);
        $user = $this->getUser();

        if($form->isSubmitted() && $form->isValid())
        {
            $date = $entryDate->getEntryDate()->format('d-m-Y');
            $entryDate->setTextDate($date);

            $this->em->persist($entryDate);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle date de rentrée a été ajoutée avec succès');
            return $this->redirectToRoute('admin.entrydate.index');
        }

        return $this->render('/admin/school/entrydate/new.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'current_menu' => 'schoolData'
        ]);
    }

    /**
     *
     * @Route("/admin/school/entrydate/{id}", name="admin.entrydate.delete", methods="DELETE")
     * @param SchoolEntryDate $date
     * @return Response
     */

    public function delete(SchoolEntryDate $date, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $date->getID(), $request->get('_token')))
        {
            $this->em->remove($date);
            $this->em->flush();
            $this->addFlash('success', 'Date de rentrée supprimée avec succès');
        }

        return $this->redirectToRoute('admin.entrydate.index');
    }
}