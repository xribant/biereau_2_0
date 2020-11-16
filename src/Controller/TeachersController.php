<?php

namespace App\Controller;

use App\Repository\NavMenuRepository;
use App\Repository\SchoolDataRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class TeachersController extends AbstractController
{
    /**
     * @var SchoolDataRepository
     */
    private $schoolDataRepo;
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;

    public function __construct(SchoolDataRepository $schoolDataRepo, NavMenuRepository $navMenuRepository)
    {
        $this->schoolDataRepo = $schoolDataRepo;
        $this->navMenuRepository = $navMenuRepository;
    }

    /**
     * @Route("/equipe_educative", name="teachers_page")
     */
    public function index()
    {
        $schoolData = $this->schoolDataRepo->findOneBy(['id' => 1]);
        $navMenu = $this->navMenuRepository->findAll();
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Equipe Educative']);

        return $this->render('teachers.html.twig', [
            'current_menu' => $currentMenu,
            'school' => $schoolData,
            'navMenu' => $navMenu,
        ]);
    }
}


