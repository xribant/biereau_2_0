<?php

namespace App\Controller\Admin;

use App\Repository\BasicPageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var BasicPageRepository
     */
    private $basicPageRepository;

    public function __construct(BasicPageRepository $basicPageRepository, EntityManagerInterface $em)
    {
        $this->basicPageRepository = $basicPageRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/dashboard", name="admin.dashboard");
     */
    public function dashboard()
    {
        return $this->render('/admin/index.html.twig',[
            'current_menu' => 'home',
        ]);
    }

}