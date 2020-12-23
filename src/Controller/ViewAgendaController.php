<?php


namespace App\Controller;

use App\Repository\AgendaRepository;
use App\Repository\NavMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/agenda")
 */
class ViewAgendaController extends AbstractController
{
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;
    /**
     * @var AgendaRepository
     */
    private $agendaRepository;

    public function __construct(NavMenuRepository $navMenuRepository, AgendaRepository $agendaRepository)
    {
        $this->navMenuRepository = $navMenuRepository;
        $this->agendaRepository = $agendaRepository;
    }

    /**
     * @Route("/", name="agenda.index")
     */
    public function index() {

        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Agenda']);

        $events = $this->agendaRepository->findAll();

        foreach($events as $event) {
            if($event->getClick()){
                $rdvs[] = [
                    'id' => $event->getId(),
                    'start' => $event->getBeginAt()->format('Y-m-d'),
                    'end' => $event->getEndAt()->format('Y-m-d'),
                    'title' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation(),
                    'click' => $event->getClick(),
                    'url' => '/agenda/evenement/'.$event->getId().'-'.$event->getSlug(),
                ];
            } else {
                $rdvs[] = [
                    'id' => $event->getId(),
                    'start' => $event->getBeginAt()->format('Y-m-d'),
                    'end' => $event->getEndAt()->format('Y-m-d'),
                    'title' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation(),
                    'click' => $event->getClick()
                ];
            }
        }

        $data = json_encode($rdvs);

        return $this->render('agenda/index.html.twig', [
            'navMenu' => $navMenu,
            'current_menu' => $currentMenu,
            'data' => $data,
        ]);
    }

    /**
     * @Route("/evenement/{id}-{slug}", name="agenda.event.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function showEvent($id, string $slug): Response {

        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Agenda']);

        $events = $this->agendaRepository->findAll();
        $clickedEvent = $this->agendaRepository->findOneBy(['id' => $id]);

        foreach($events as $event) {
            if($event->getClick()){
                $rdvs[] = [
                    'id' => $event->getId(),
                    'start' => $event->getBeginAt()->format('Y-m-d'),
                    'end' => $event->getEndAt()->format('Y-m-d'),
                    'title' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation(),
                    'click' => $event->getClick(),
                    'url' => '/agenda/evenement/'.$event->getId().'-'.$event->getSlug(),
                ];
            } else {
                $rdvs[] = [
                    'id' => $event->getId(),
                    'start' => $event->getBeginAt()->format('Y-m-d'),
                    'end' => $event->getEndAt()->format('Y-m-d'),
                    'title' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation(),
                    'click' => $event->getClick()
                ];
            }
        }

        $data = json_encode($rdvs);

        if ($event->getSlug() !== $slug ) {
            return $this->redirectToRoute('agenda.event.show', [
               'id' => $event->getId(),
               'slug' => $event->getSlug(),
            ], 301);
        }

        return $this->render('agenda/index.html.twig', [
            'navMenu' => $navMenu,
            'current_menu' => $currentMenu,
            'data' => $data,
            'event' => $clickedEvent,
        ]);
    }
}