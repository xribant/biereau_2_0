<?php

namespace App\Controller;

use App\Entity\ContactSub;
use App\Form\ContactSubType;
use App\Notification\ContactNotification;
use App\Repository\AcademicYearRepository;
use App\Repository\ContactSubRepository;
use App\Repository\SchoolDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{
    /**
     * @var SchoolDataRepository
     */
    private $schoolDataRepo;

    /**
     * @var AcademicYearRepository
     */
    private $academicYearRepo;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ContactSubRepository $contactSubRepo, SchoolDataRepository $schoolDataRepo, AcademicYearRepository $academicYearRepo,EntityManagerInterface $em)
    {
        $this->contactSubRepo = $contactSubRepo;
        $this->schoolDataRepo = $schoolDataRepo;
        $this->academicYearRepo = $academicYearRepo;
        $this->em = $em;
    }


    /**
     * @Route("/inscription", name="subscription.index")
     */
    public function index(Request $request, ContactNotification $notification)
    {
        $contactSub = new ContactSub();
        $form = $this->createForm(ContactSubType::class, $contactSub);

        $school = $this->schoolDataRepo->findOneBy(['id' => 1]);
        $academicYear = $this->academicYearRepo->findOneBy(['id' => 1]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($contactSub);
            $this->em->flush();

            $notification->notify($contactSub, $school);

            $date = $contactSub->getSessionDate()->format('d/m/Y');
            $this->addFlash('success', 'Votre particpiaption à la séance d\'information du '.$date.' a bien été enregistrée.
                                                        <br> Un e-mail de confirmation vous a été envoyé.');
            return $this->redirectToRoute('subscription.index', [
            ]);
        }

        return $this->render('subscription.html.twig', [
            'current_menu' => 'Inscription',
            'academicYear' => $academicYear,
            'school' => $school,
            'form' => $form->createView()
        ]);
    }


}


