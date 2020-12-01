<?php

namespace App\Controller;

use App\Repository\SchoolDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class AboutController extends AbstractController
{
    /**
     * @Route("/a_propos", name="about.index")
     */
    public function showAboutPage()
    {
        return $this->render('about.html.twig');
    }
}


