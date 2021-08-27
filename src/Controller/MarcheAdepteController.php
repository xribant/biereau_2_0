<?php


namespace App\Controller;


use App\Repository\AdeptCycleKmRepository;
use App\Repository\AdeptCycleRepository;
use App\Repository\AdeptPlaceLocationRepository;
use App\Repository\NavMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MarcheAdepteController
 * @package App\Controller
 * @Route("/espace-parents/la-fausse-vraie-marche-adeptes-2021/resultats")
 */
class MarcheAdepteController extends AbstractController
{
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;
    /**
     * @var AdeptCycleKmRepository
     */
    private $adeptCycleKmRepository;
    /**
     * @var AdeptCycleRepository
     */
    private $adeptCycleRepository;
    /**
     * @var AdeptPlaceLocationRepository
     */
    private $adeptPlaceLocationRepository;

    public function __construct(NavMenuRepository $navMenuRepository, AdeptCycleKmRepository $adeptCycleKmRepository, AdeptCycleRepository $adeptCycleRepository, AdeptPlaceLocationRepository $adeptPlaceLocationRepository)
    {
        $this->navMenuRepository = $navMenuRepository;
        $this->adeptCycleRepository = $adeptCycleRepository;
        $this->adeptCycleKmRepository = $adeptCycleKmRepository;
        $this->adeptPlaceLocationRepository = $adeptPlaceLocationRepository;
    }

    /**
     * @Route("/", name="marche_adepte_page")
     */
    public function index() {

        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Espace Parents']);

        $cycles = $this->adeptCycleRepository->findAll();
        $locations = $this->adeptPlaceLocationRepository->findAll();
        $allParcours = $this->adeptCycleKmRepository->findAll();
        $totalKm = 0;

        foreach($allParcours as $parcour)
        {
            $totalKm = $totalKm + $parcour->getDistance();
        }

        return $this->render('espace-parents/marche-adepte/index.html.twig', [
            'current_menu' => $currentMenu,
            'navMenu' => $navMenu,
            'cycles' => $cycles,
            'locations' => $locations,
            'totalKm' => $totalKm
        ]);
    }

}