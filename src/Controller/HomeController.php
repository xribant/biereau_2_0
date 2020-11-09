<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\SchoolData;
use App\Form\Admin\School\ContactType;
use App\Repository\SchoolDataRepository;
use App\Repository\SiteHomePageCarouselRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class HomeController extends AbstractController
{

    /**
     * @var SchoolDataRepository
     */
    private $schoolDataRepo;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var SiteHomePageCarouselRepository
     */
    private $carouselRepository;

    public function __construct(SchoolDataRepository $schoolDataRepo, SiteHomePageCarouselRepository $carouselRepository, EntityManagerInterface $em)
    {
        $this->schoolDataRepo = $schoolDataRepo;
        $this->em = $em;
        $this->carouselRepository = $carouselRepository;
    }

    /**
     * @Route("/", name="home.index")
     * @return Response
     */
    public function index()
    {
        $carousel = $this->carouselRepository->findAll();
        $schoolData = $this->schoolDataRepo->findOneBy(['id' => 1]);

        return $this->render('home.html.twig', [
            'current_menu' => 'home',
            'school' => $schoolData,
            'carousel' => $carousel
        ]);
    }
}


