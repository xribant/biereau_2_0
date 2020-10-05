<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class HomeController extends AbstractController {

    /**
     * @Route("/", name="home_page")
     */
    public function showHomePage()
    {
        return $this->render('home.html.twig', [
            'current_menu' => 'home'
        ]);
    }
}


