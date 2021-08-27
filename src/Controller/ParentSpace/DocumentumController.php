<?php

namespace App\Controller\ParentSpace;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-parents")
 */
class DocumentumController extends AbstractController
{
    /**
     * @Route("/documents/download", name="documentum")
     */
    public function index(): Response
    {
        
        return $this->render('parent_space/documentum.html.twig');
    }
}
