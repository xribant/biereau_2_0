<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class AboutController extends AbstractController {

    /**
     * @Route("/about", name="about.index")
     */
    public function showAboutPage()
    {
        return $this->render('about.html.twig');
    }
}


