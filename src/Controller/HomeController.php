<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Admin\School\ContactType;
use App\Repository\NavMenuRepository;
use App\Repository\NewsRepository;
use App\Repository\SchoolDataRepository;
use App\Repository\SchoolValueRepository;
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
    /**
     * @var NewsRepository
     */
    private $newsRepository;
    /**
     * @var SchoolValueRepository
     */
    private $schoolValueRepository;
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;

    public function __construct(SchoolDataRepository $schoolDataRepo, SiteHomePageCarouselRepository $carouselRepository, NavMenuRepository $navMenuRepository, NewsRepository $newsRepository, SchoolValueRepository $schoolValueRepository, EntityManagerInterface $em)
    {
        $this->schoolDataRepo = $schoolDataRepo;
        $this->em = $em;
        $this->carouselRepository = $carouselRepository;
        $this->newsRepository = $newsRepository;
        $this->schoolValueRepository = $schoolValueRepository;
        $this->navMenuRepository = $navMenuRepository;
    }

    /**
     * @Route("/", name="home.index")
     * @return Response
     */
    public function index()
    {
        $carousel = $this->carouselRepository->findAll();
        $schoolData = $this->schoolDataRepo->findOneBy(['id' => 1]);
        $news = $this->newsRepository->findAll();
        $schoolValues = $this->schoolValueRepository->findAll();
        $navMenu = $this->navMenuRepository->findAll();
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Accueil']);

        return $this->render('home.html.twig', [
            'current_menu' => $currentMenu,
            'school' => $schoolData,
            'carousel' => $carousel,
            'news' => $news,
            'school_values' => $schoolValues,
            'navMenu' => $navMenu,
        ]);
    }
}


