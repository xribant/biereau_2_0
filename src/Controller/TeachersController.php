<?php

namespace App\Controller;

use App\Repository\SchoolDataRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class TeachersController extends AbstractController
{
    /**
     * @var SchoolDataRepository
     */
    private $schoolDataRepo;

    public function __construct(SchoolDataRepository $schoolDataRepo)
    {
        $this->schoolDataRepo = $schoolDataRepo;
    }

    /**
     * @Route("/equipe_educative", name="teachers_page")
     */
    public function index()
    {
        $schoolData = $this->schoolDataRepo->findOneBy(['id' => 1]);
        return $this->render('teachers.html.twig', [
            'current_menu' => 'teachers',
            'school' => $schoolData
        ]);
    }
}


