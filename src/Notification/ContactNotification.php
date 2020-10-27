<?php


namespace App\Notification;

use App\Entity\ContactSub;
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

    public function __construct(\Swift_Mailer $mailer, Environment $renderer )
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(ContactSub $contact)
    {
        $message = (new \Swift_Message('Collège du Biereau - Préinscription 2020-2021'))
            -> setFrom('noreply@biereau.be')
            -> setTo('xribant@gmail.com')
            -> setReplyTo($contact->getParentEmail())
            -> setBody($this->renderer->render('emails/contactsubscriber.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }
}