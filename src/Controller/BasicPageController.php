<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Repository\BasicPageRepository;
use App\Repository\NavMenuRepository;
use Cocur\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BasicPageController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var NavMenuRepository
     */
    private $navMenuRepository;
    /**
     * @var ArticleRepository
     */
    private $articleRepository;
    /**
     * @var BasicPageRepository
     */
    private $basicPageRepository;

    public function __construct( BasicPageRepository $basicPageRepository, ArticleRepository $articleRepository, EntityManagerInterface $em, NavMenuRepository $navMenuRepository)
    {
        $this->em = $em;
        $this->navMenuRepository = $navMenuRepository;
        $this->articleRepository = $articleRepository;
        $this->basicPageRepository = $basicPageRepository;
    }

    /**
     * @Route("/{mainMenu}/{subMenu}", name="show.page")
     */
    public function index($mainMenu, $subMenu)
    {
        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $currentMenu = $this->navMenuRepository->findOneBy(['route' => $mainMenu]);
        $page = $this->basicPageRepository->findOneBy(['name' => $subMenu]);
        $articles = $this->articleRepository->findBy(['parentPage' => $page]);


        return $this->render($mainMenu.'/'.$subMenu.'/index.html.twig', [
            'current_menu' => $currentMenu,
            'navMenu' => $navMenu,
            'articles' => $articles,
            'page' => $page,
        ]);
    }
}