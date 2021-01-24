<?php


namespace App\Controller\Admin\Notification;


use App\Entity\EmailNotification;
use App\Entity\RegistrationContent;
use App\Form\EmailNotificationFormType;
use App\Repository\EmailNotificationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/notification")
 */
class NotificationController extends AbstractController
{
    /**
     * @var EmailNotification
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(EmailNotificationRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/liste", name="admin.notification.index")
     */
    public function index() {

        $notifications = $this->repository->findAll();

        return $this->render('admin/notifications/index.html.twig', [
            'notifications' => $notifications,
            'current_menu' => 'notifications',
        ]);
    }

    /**
     * @Route("/ajouter", name="admin.notification.new")
     */
    public function add(Request $request) {

        $notification = new EmailNotification();

        $form = $this->createForm(EmailNotificationFormType::class, $notification);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $notification->setReplyToAddress('no-reply@biereau.be');
            $this->em->persist($notification);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle notification a été créée');
            return $this->redirectToRoute('admin.notification.index', [
                'current_menu' => 'notifications'
            ]);
        }

        return $this->render('admin/notifications/add.html.twig', [
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="admin.notification.edit", methods="GET|POST")
     * @param EmailNotification $notification
     * @return Response
     */
    public function edit(Request $request, EmailNotification $notification) {

        $form = $this->createForm(EmailNotificationFormType::class, $notification);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La notification a été modifiée avec succès');
            return $this->redirectToRoute('admin.notification.index');
        }

        return $this->render('admin/notifications/edit.html.twig', [
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/supprimer/{id}", name="admin.notification.delete", methods="DELETE")
     * @param EmailNotification $notification
     * @return Response
     */
    public function delete(Request $request, EmailNotification $notification) {

        if($this->isCsrfTokenValid('delete' . $notification->getID(), $request->get('_token')))
        {
            $this->em->remove($notification);
            $this->em->flush();
            $this->addFlash('success', 'Notification supprimée avec succès');
        }

        return $this->redirectToRoute('admin.notification.index');

    }
}