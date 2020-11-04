<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin.dashboard");
     */
    public function dashboard()
    {
        $currentUser = $this->getUser();
        return $this->render('/admin/index.html.twig',[
            'current_user' => $currentUser,
            'current_menu' => 'home'
        ]);
    }

}