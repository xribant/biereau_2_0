<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Repository\BasicPageRepository;
use App\Repository\NavMenuRepository;
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
     * @Route("/{navMenu}/{subMenu}", name="show.page", requirements={"subMenu": "[a-z0-9\-]*"})
     */
    public function index($subMenu)
    {
        $navMenu = $this->navMenuRepository->findBy(array(), ['id' => 'asc'] );
        $page = $this->basicPageRepository->findOneBy(['name' => $subMenu]);
        $currentMenu = $page->getParentNavMenu();
        $articles = $this->articleRepository->findBy(['parentPage' => $page]);


        return $this->render('/basic-page/index.html.twig', [
            'current_menu' => $currentMenu,
            'navMenu' => $navMenu,
            'articles' => $articles,
            'page' => $page,
        ]);
    }
}