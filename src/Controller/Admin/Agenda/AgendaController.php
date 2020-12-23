<?php

namespace App\Controller\Admin\Agenda;

use App\Entity\Agenda;
use App\Form\AgendaType;
use App\Repository\AgendaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/agenda")
 */
class AgendaController extends AbstractController
{
    /**
     * @Route("/", name="admin.agenda.index", methods={"GET"})
     */
    public function index(AgendaRepository $agendaRepository): Response
    {
        return $this->render('admin/agenda/index.html.twig', [
            'agendas' => $agendaRepository->findAll(),
            'current_menu' => 'contenu',
        ]);
    }

    /**
     * @Route("/new", name="admin.agenda.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $agenda = new Agenda();
        $form = $this->createForm(AgendaType::class, $agenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($agenda->getClick() == true) {
                $agenda->setUrl('agenda/'.$agenda->getId());
            }
            $entityManager->persist($agenda);
            $entityManager->flush();

            return $this->redirectToRoute('admin.agenda.index');
        }

        return $this->render('admin/agenda/new.html.twig', [
            'current_menu' => 'Contenu',
            'agenda' => $agenda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.agenda.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Agenda $agenda): Response
    {
        $form = $this->createForm(AgendaType::class, $agenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.agenda.index');
        }

        return $this->render('admin/agenda/edit.html.twig', [
            'current_menu' => 'Contenu',
            'agenda' => $agenda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.agenda.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Agenda $agenda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agenda->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agenda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.agenda.index');
    }
}
