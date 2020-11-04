<?php

namespace App\Controller;

use App\Repository\SchoolDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class AboutController extends AbstractController
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
     * @Route("/a_propos", name="about.index")
     */
    public function showAboutPage()
    {
        $schoolData = $this->schoolDataRepo->findOneBy(['id' => 1]);
        return $this->render('about.html.twig', [
            'school' => $schoolData
        ]);
    }
}


