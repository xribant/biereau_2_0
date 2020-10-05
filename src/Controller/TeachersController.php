<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class TeachersController extends AbstractController {

    /**
     * @Route("/equipe_educative", name="teachers_page")
     */
    public function showTeachersPage()
    {
        return $this->render('teachers.html.twig', [
            'current_menu' => 'teachers'
        ]);
    }
}


