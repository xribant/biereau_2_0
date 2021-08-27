<?php


namespace App\Controller\Admin\MarcheAdepte;


use App\Entity\AdeptPlaceLocation;
use App\Form\AdeptPlaceLocationType;
use App\Repository\AdeptPlaceLocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MarcheAdepteLocationController
 * @package App\Controller\Admin\MarcheAdepte
 * @Route("/admin/marche-adepte/locations")
 */
class MarcheAdepteLocationController extends AbstractController
{

    /**
     * @var AdeptPlaceLocationRepository
     */
    private $adeptPlaceLocationRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(AdeptPlaceLocationRepository $adeptPlaceLocationRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->adeptPlaceLocationRepository = $adeptPlaceLocationRepository;
    }

    /**
     * @Route("/", name="admin.marche_adepte_location.index")
     */
    public function index()
    {
        $locations = $this->adeptPlaceLocationRepository->findAll();

        return $this->render('admin/marche-adepte/location/index.html.twig', [
            'current_menu' => 'Marche Adepte',
            'locations' => $locations,
        ]);
    }

    /**
     * @Route("/new", name="admin.marche_adepte_location.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $location = new AdeptPlaceLocation();

        $form = $this->createForm(AdeptPlaceLocationType::class, $location);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $location->setUpdatedAt(new \DateTime());
            $distance = $location->getDistance();
            $location->setDistance(round($distance));
            $this->em->persist($location);
            $this->em->flush();
            $this->addFlash('success', 'Un nouveau lieu a été ajouté');
            return $this->redirectToRoute('admin.marche_adepte_location.index', [
                'current_menu' => 'Marche Adepte'
            ]);
        }

        return $this->render('admin/marche-adepte/location/new.html.twig', [
            'current_menu' => 'Marche Adepte',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin.marche_adepte_location.edit", methods="GET|POST")
     * @param AdeptPlaceLocation $location
     * @return Response
     */
    public function edit(AdeptPlaceLocation $location, Request $request)
    {
        $form = $this->createForm(AdeptPlaceLocationType::class, $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $distance = $location->getDistance();
            $location->setDistance(round($distance));
            $this->em->persist($location);
            $this->em->flush();
            $this->addFlash('success', 'Le lieu a été modifié avec succès');
            return $this->redirectToRoute('admin.marche_adepte_location.index');
        }

        return $this->render('admin/marche-adepte/location/edit.html.twig', [
            'location' => $location,
            'current_menu' => 'Marche Adepte',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin.marche_adepte_location.delete", methods="DELETE")
     * @param AdeptPlaceLocation $location
     * @return Response
     */
    public function delete(AdeptPlaceLocation $location, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $location->getID(), $request->get('_token')))
        {
            $this->em->remove($location);
            $this->em->flush();
            $this->addFlash('success', 'Lieu supprimé avec succès');
        }

        return $this->redirectToRoute('admin.marche_adepte_location.index');
    }
}