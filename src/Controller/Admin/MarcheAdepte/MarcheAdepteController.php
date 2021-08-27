<?php


namespace App\Controller\Admin\MarcheAdepte;


use App\Entity\AdeptCycleKm;
use App\Form\AdeptCycleKmType;
use App\Repository\AdeptCycleKmRepository;
use App\Repository\AdeptPlaceLocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MarcheAdepteController
 * @package App\Controller\Admin\MarcheAdepte
 * @Route("/admin/marche-adepte")
 */
class MarcheAdepteController extends AbstractController
{

    /**
     * @var AdeptCycleKm
     */
    private $adeptCycleKmRepository;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var AdeptPlaceLocationRepository
     */
    private $adeptPlaceLocationRepository;

    public function __construct(AdeptPlaceLocationRepository $adeptPlaceLocationRepository,AdeptCycleKmRepository $adeptCycleKmRepository , EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->adeptCycleKmRepository = $adeptCycleKmRepository;
        $this->adeptPlaceLocationRepository = $adeptPlaceLocationRepository;
    }

    /**
     * @Route("/", name="admin.marche_adepte.index")
     */
    public function index()
    {
        $parcours = $this->adeptCycleKmRepository->findAll();

        return $this->render('admin/marche-adepte/index.html.twig', [
            'current_menu' => 'Marche Adepte',
            'parcours' => $parcours,
        ]);
    }

    /**
     * @Route("/new", name="admin.marche_adepte.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $parcour = new AdeptCycleKm();

        $form = $this->createForm(AdeptCycleKmType::class, $parcour);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $parcour->setAddedAt(new \DateTime());
            $distance = $parcour->getDistance();
            $parcour->setDistance(round($distance));

            $this->em->persist($parcour);
            $this->em->flush();
            $this->addFlash('success', 'Un nouveau parcour a été ajoutée');
            return $this->redirectToRoute('admin.marche_adepte.index', [
                'current_menu' => 'Marche Adepte'
            ]);
        }

        return $this->render('admin/marche-adepte/new.html.twig', [
            'current_menu' => 'Marche Adepte',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin.marche_adepte.edit", methods="GET|POST")
     * @param AdeptCycleKm $parcour
     * @return Response
     */
    public function edit(AdeptCycleKm $parcour, Request $request)
    {
        $form = $this->createForm(AdeptCycleKmType::class, $parcour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Le parcour a été modifié avec succès');
            return $this->redirectToRoute('admin.marche_adepte.index');
        }

        return $this->render('admin/marche-adepte/edit.html.twig', [
            'parcour' => $parcour,
            'current_menu' => 'Marche Adepte',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin.marche_adepte.delete", methods="DELETE")
     * @param AdeptCycleKm $parcour
     * @return Response
     */
    public function delete(AdeptCycleKm $parcour, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $parcour->getID(), $request->get('_token')))
        {
            $this->em->remove($parcour);
            $this->em->flush();
            $this->addFlash('success', 'Parcour supprimé avec succès');
        }

        return $this->redirectToRoute('admin.marche_adepte.index');
    }
}