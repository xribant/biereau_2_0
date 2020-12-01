<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\Article;
use App\Entity\BasicPage;
use App\Repository\ArticleRepository;
use App\Repository\BasicPageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageContentController extends AbstractController
{
    /**
     * @var BasicPage
     */
    private $pageRepository;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(BasicPageRepository $pageRepository, ArticleRepository $articleRepository, EntityManagerInterface $em)
    {
        $this->pageRepository = $pageRepository;
        $this->em = $em;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/admin/contenu/pages", name="admin.content.basic_page.index", methods="GET|POST")
     * @param BasicPage
     * @return Response
     */
    public function showListPages()
    {
        $pages = $this->pageRepository->findAll();

        return $this->render('admin/content/page_content/pages.html.twig', [
            'current_menu' => 'contenu',
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("/admin/contenu/page/edit/{id}", name="admin.content.basic_page.edit", methods="GET|POST")
     * @param Article $article
     * @return Response
     */
    public function showPageArticles($id)
    {
        $page = $this->pageRepository->findOneBy([ 'id' => $id]);
        $pages = $this->pageRepository->findAll();

        return $this->render('admin/content/page_content/page_details.html.twig', [
            'current_menu' => 'contenu',
            'page' => $page,
            'pages' => $pages,
        ]);
    }
}