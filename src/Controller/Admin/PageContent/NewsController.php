<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\News;
use App\Form\NewsFormType;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @var News
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(NewsRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/content/news", name="admin.content.news")
     */
    public function index()
    {
        $news = $this->repository->findAll();

        return $this->render('admin/content/news/index.html.twig', [
            'current_menu' => 'contenu',
            'news' => $news,
        ]);
    }

    /**
     * @Route("/admin/content/news/new", name="admin.content.news.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $news = new News();

        $form = $this->createForm(NewsFormType::class, $news);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $news->setCreatedAt(new \DateTime());
            $this->em->persist($news);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle news a été ajoutée');
            return $this->redirectToRoute('admin.content.news', [
                'current_menu' => 'contenu'
            ]);
        }

        return $this->render('admin/content/news/new.html.twig', [
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/news/edit/{id}", name="admin.content.news.edit", methods="GET|POST")
     * @param News $news
     * @return Response
     */
    public function edit(News $news, Request $request)
    {
        $form = $this->createForm(NewsFormType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La news a été modifiée avec succès');
            return $this->redirectToRoute('admin.content.news');
        }

        return $this->render('admin/content/news/edit.html.twig', [
            'news' => $news,
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/news/delete/{id}", name="admin.content.news.delete", methods="DELETE")
     * @param News $news
     * @return Response
     */
    public function delete(News $news, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $news->getID(), $request->get('_token')))
        {
            $this->em->remove($news);
            $this->em->flush();
            $this->addFlash('success', 'News supprimée avec succès');
        }

        return $this->redirectToRoute('admin.content.news');
    }
}