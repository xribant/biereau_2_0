<?php


namespace App\Notification;

use App\Entity\ContactSub;
use App\Entity\SchoolData;
use App\Repository\AcademicYearRepository;
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

    public function __construct(\Swift_Mailer $mailer, Environment $renderer, AcademicYearRepository $academicYearRepo)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
        $this->academicYearRepo = $academicYearRepo;
    }

    public function notify(ContactSub $contact, SchoolData $schoolData)
    {
        $academicYear = $this->academicYearRepo->findOneBy(['id' => 1]);

        $message = (new \Swift_Message('Collège du Biereau - Préinscription '.$academicYear->getYear()))
            -> setFrom('noreply@biereau.be')
            -> setTo($contact->getParentEmail())
            -> setReplyTo($contact->getParentEmail())
            -> setBody($this->renderer->render('emails/contactsubscriber.html.twig', [
                'schoolData' => $schoolData,
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);

        $message = (new \Swift_Message('Biereau.be - Nouvelle préinscription '.$academicYear->getYear()))
            -> setFrom('noreply@biereau.be')
            -> setTo('xribant@gmail.com')
            -> setReplyTo('xribant@gmail.com')
            -> setBody($this->renderer->render('emails/contactschoolsub.html.twig', [
                'schoolData' => $schoolData,
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);

    }
}