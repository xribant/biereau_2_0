<?php


namespace App\Controller;


use App\Repository\NavMenuRepository;
use App\Repository\SchoolDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GarderieController extends AbstractController
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
     * @var NavMenuRepository
     */
    private $navMenuRepository;

    public function __construct(SchoolDataRepository $schoolDataRepo, EntityManagerInterface $em, NavMenuRepository $navMenuRepository)
    {
        $this->schoolDataRepo = $schoolDataRepo;
        $this->em = $em;
        $this->navMenuRepository = $navMenuRepository;
    }

    /**
     * @Route("/parascolaire/garderie", name="parascolaire.garderie.index")
     */
    public function index()
    {
        $schoolData = $this->schoolDataRepo->findOneBy(['id' => 1]);
        $navMenu = $this->navMenuRepository->findAll();
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Parascolaire']);

        return $this->render('parascolaire/garderie/index.html.twig', [
            'current_menu' => $currentMenu,
            'school' => $schoolData,
            'navMenu' => $navMenu,
        ]);
    }
}