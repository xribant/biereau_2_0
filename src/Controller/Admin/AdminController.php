<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin.index");
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('/admin/index.html.twig',[
            'user' => $user,
            'current_menu' => 'home'
        ]);
    }

}