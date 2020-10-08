<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class HomeController extends AbstractController {

    /**
     * @Route("/", name="home.index")
     */
    public function index()
    {
        return $this->render('home.html.twig', [
            'current_menu' => 'home'
        ]);
    }
}


