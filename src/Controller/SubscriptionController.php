<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SubscriptionController extends AbstractController {

    /**
     * @Route("/inscription", name="subscription.index")
     * @return Response
     */
    public function show(): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        return $this->render('subscription.html.twig', [
            'current_menu' => 'subscription'
        ]);
    }


}


