<?php

namespace App\Controller;

use App\Entity\ContactSub;
use App\Form\ContactSubType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController {

    /**
     * @Route("/inscription", name="subscription.index")
     */
    public function index()
    {
        $contactSub = new ContactSub();
        $form = $this->createForm(ContactSubType::class, $contactSub);

        return $this->render('subscription.html.twig', [
            'current_menu' => 'Inscription',
            'form' => $form->createView()
        ]);
    }


}


