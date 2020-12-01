<?php

namespace App\Controller;

use App\Repository\NavMenuRepository;
use App\Repository\SchoolDataRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class TeachersController extends AbstractController
{
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;

    public function __construct(NavMenuRepository $navMenuRepository)
    {
        $this->navMenuRepository = $navMenuRepository;
    }

    /**
     * @Route("/equipe-educative", name="teachers_page")
     */
    public function index()
    {
        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Equipe Educative']);

        return $this->render('teachers.html.twig', [
            'current_menu' => $currentMenu,
            'navMenu' => $navMenu,
        ]);
    }
}


