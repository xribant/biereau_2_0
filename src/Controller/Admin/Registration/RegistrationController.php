<?php


namespace App\Controller\Admin\Registration;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/admin/inscriptions/gestion", name="admin.registrations.show");
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('/admin/school/registration/view.html.twig',[
            'user' => $user,
            'current_menu' => 'inscriptions'
        ]);
    }
}