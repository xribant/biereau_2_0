<?php

namespace App\Controller;

use App\Entity\ContactSub;
use App\Entity\RegistrationContent;
use App\Form\ContactSubType;
use App\Notification\ContactNotification;
use App\Repository\AcademicYearRepository;
use App\Repository\ContactSubRepository;
use App\Repository\NavMenuRepository;
use App\Repository\RegistrationContentRepository;
use App\Repository\RegistrationDateRepository;
use App\Repository\SchoolDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{
    /**
     * @var AcademicYearRepository
     */
    private $academicYearRepo;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var RegistrationDateRepository
     */
    private $registrationDateRepository;
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;
    /**
     * @var SchoolDataRepository
     */
    private $schoolDataRepository;

    /**
     * @var RegistrationContent
     */
    private $registrationContentRepository;

    /**
     * SubscriptionController constructor.
     * @param ContactSubRepository $contactSubRepo
     * @param SchoolDataRepository $schoolDataRepository
     * @param NavMenuRepository $navMenuRepository
     * @param AcademicYearRepository $academicYearRepo
     * @param RegistrationDateRepository $registrationDateRepository
     * @param EntityManagerInterface $em
     * @param RegistrationContent $registrationContentRepository
     */

    public function __construct(ContactSubRepository $contactSubRepo, SchoolDataRepository $schoolDataRepository, NavMenuRepository $navMenuRepository, AcademicYearRepository $academicYearRepo, RegistrationDateRepository $registrationDateRepository, EntityManagerInterface $em, RegistrationContentRepository $registrationContentRepository)
    {
        $this->contactSubRepo = $contactSubRepo;
        $this->academicYearRepo = $academicYearRepo;
        $this->em = $em;
        $this->registrationDateRepository = $registrationDateRepository;
        $this->navMenuRepository = $navMenuRepository;
        $this->schoolDataRepository = $schoolDataRepository;
        $this->registrationContentRepository = $registrationContentRepository;
    }


    /**
     * @Route("/inscription", name="subscription.index")
     */
    public function index(Request $request, ContactNotification $notification)
    {
        $contactSub = new ContactSub();
        $form = $this->createForm(ContactSubType::class, $contactSub);

        $schoolData = $this->schoolDataRepository->findOneBy(['id' => 1]);

        $academicYear = $this->academicYearRepo->findOneBy(['id' => 1]);
        $regDates = $this->registrationDateRepository->findAll();
        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Infos Pratiques']);
        $registrationContent = $this->registrationContentRepository->findOneBy(['id' => 1]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($contactSub);
            $this->em->flush();

            $notificationCategory = "Inscription";
            $notification->notify($contactSub, $schoolData);

            $date = $contactSub->getSessionDate()->format('d/m/Y');
            $this->addFlash('success', 'Votre participation à la séance d\'information du '.$date.' a bien été enregistrée.
                                                        <br> Un e-mail de confirmation vous a été envoyé.');
            return $this->redirectToRoute('subscription.index', [
            ]);
        }

        return $this->render('subscription.html.twig', [
            'current_menu' => $currentMenu,
            'academicYear' => $academicYear,
            'registration_dates' => $regDates,
            'pageContent' => $registrationContent,
            'navMenu' => $navMenu,
            'form' => $form->createView()
        ]);
    }


}


