<?php

namespace App\Controller\ParentSpace;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParentSpaceController extends AbstractController
{
    /**
     * @Route("/espace-parents", name="parent_space")
     */
    public function index(): Response
    {
        return $this->render('parent_space/index.html.twig');
    }
}
