<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController {

    /**
     * @Route("/inscription", name="subscription.index")
     */
    public function index()
    {
        return $this->render('subscription.html.twig');
    }


}


