<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class AboutController extends AbstractController {

    /**
     * @Route("/a_propos", name="about_page")
     */
    public function showAboutPage()
    {
        return $this->render('about.html.twig');
    }
}


