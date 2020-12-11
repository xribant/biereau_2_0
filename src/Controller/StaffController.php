<?php

namespace App\Controller;

use App\Repository\FonctionRepository;
use App\Repository\MemberRepository;
use App\Repository\NavMenuRepository;
use App\Repository\SchoolDataRepository;
use App\Repository\StaffGroupRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class StaffController extends AbstractController
{
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;
    /**
     * @var MemberRepository
     */
    private $memberRepository;
    /**
     * @var FonctionRepository
     */
    private $fonctionRepository;
    /**
     * @var StaffGroupRepository
     */
    private $staffGroupRepository;

    public function __construct(NavMenuRepository $navMenuRepository, MemberRepository $memberRepository, FonctionRepository $fonctionRepository, StaffGroupRepository $staffGroupRepository)
    {
        $this->navMenuRepository = $navMenuRepository;
        $this->memberRepository = $memberRepository;
        $this->fonctionRepository = $fonctionRepository;
        $this->staffGroupRepository = $staffGroupRepository;
    }

    /**
     * @Route("/equipe-educative", name="teachers_page")
     */
    public function index()
    {
        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $currentMenu = $this->navMenuRepository->findOneBy(['name' => 'Equipe Educative']);
        $members = $this->memberRepository->findAll();
        $fonctions = $this->fonctionRepository->findAll();
        $groupes = $this->staffGroupRepository->findAll();

        return $this->render('staff.html.twig', [
            'current_menu' => $currentMenu,
            'navMenu' => $navMenu,
            'members' => $members,
            'fonctions' => $fonctions,
            'groupes' => $groupes,
        ]);
    }
}


