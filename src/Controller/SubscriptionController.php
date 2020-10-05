<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SubscriptionController extends AbstractController {

    /**
     * @Route("/inscription", name="subscription_page")
     */
    public function showSubscriptionPage()
    {
        return $this->render('subscription.html.twig', [
            'current_menu' => 'subscription',
        ]);
    }
}


