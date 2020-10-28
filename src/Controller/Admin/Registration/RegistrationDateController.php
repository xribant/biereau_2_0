<?php

namespace App\Controller\Admin\Registration;

use App\Entity\RegistrationDate;
use App\Form\Admin\School\RegistrationDateType;
use App\Repository\RegistrationDateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationDateController extends AbstractController
{
    /**
     * @var RegistrationDateRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(RegistrationDateRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/ecole/inscriptions/jours", name="admin.registration.index")
     * @return Response
     */
    public function index()
    {
        $registrationDates = $this->repository->findAll();
        $user = $this->getUser();

        return $this->render('/admin/school/registration/index.html.twig', [
            'registrationDates' => $registrationDates,
            'user' => $user,
            'current_menu' => 'inscriptions'
        ]);
    }

    /**
     * @Route("/admin/ecole/inscriptions/jours/nouveau", name="admin.registration.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $registrationDate = new RegistrationDate();
        $form = $this->createForm(RegistrationDateType::class, $registrationDate);
        $form->handleRequest($request);
        $user = $this->getUser();

        if($form->isSubmitted() && $form->isValid())
        {
            $date = $registrationDate->getRegDate()->format('d-m-Y');

            $registrationDate->setTextDate($date);
            $this->em->persist($registrationDate);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle date a été ajoutée avec succès');
            return $this->redirectToRoute('admin.registration.index');
        }

        return $this->render('/admin/school/registration/new.html.twig', [
            'user' => $user,
            'current_menu' => 'inscriptions',
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/admin/ecole/inscriptions/jours/supprimer/{id}", name="admin.registration.delete", methods="DELETE")
     * @param RegistrationDate $registrationDate
     * @return Response
     */
    public function delete(RegistrationDate $registrationDate, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $registrationDate->getID(), $request->get('_token')))
        {
            $this->em->remove($registrationDate);
            $this->em->flush();
            $this->addFlash('success', 'Date supprimée avec succès');
        }

        return $this->redirectToRoute('admin.registration.index');
    }


}