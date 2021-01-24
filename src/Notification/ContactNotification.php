<?php


namespace App\Notification;

use App\Entity\ContactSub;
use App\Entity\EmailNotification;
use App\Entity\SchoolData;
use App\Repository\AcademicYearRepository;
use App\Repository\EmailNotificationRepository;
use Twig\Environment;



class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    /**
     * @var AcademicYearRepository
     */
    private $academicYearRepo;
    /**
     * @var EmailNotificationRepository
     */
    private $emailNotificationRepository;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer, AcademicYearRepository $academicYearRepo, EmailNotificationRepository $emailNotificationRepository)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
        $this->academicYearRepo = $academicYearRepo;
        $this->emailNotificationRepository = $emailNotificationRepository;
    }

    public function notify(ContactSub $contact, SchoolData $schoolData)
    {
        $academicYear = $this->academicYearRepo->findOneBy(['id' => 1]);
        $notification = $this->emailNotificationRepository->findOneBy(['id' => 2]);

        $message = (new \Swift_Message('Collège du Biereau - Préinscription '.$academicYear->getYear()))
            -> setFrom($notification->getFromAddress())
            -> setTo($contact->getParentEmail())
            -> setReplyTo($contact->getParentEmail())
            -> setBody($this->renderer->render('emails/contactsubscriber.html.twig', [
                'notificationText' => $notification->getBodyText(),
                'schoolData' => $schoolData,
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);

        $message = (new \Swift_Message('Biereau.be - Nouvelle préinscription '.$academicYear->getYear()))
            -> setFrom($notification->getFromAddress())
            -> setTo($notification->getToAddress())
            -> setReplyTo('no-reply@biereau.be')
            -> setBody($this->renderer->render('emails/contactschoolsub.html.twig', [
                'schoolData' => $schoolData,
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);

    }
}