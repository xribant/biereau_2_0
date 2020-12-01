<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @var Article
     */
    private $articleRepository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $em)
    {
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/contenu/page/{pageid}/article/new", name="admin.content.article.new")
     * @return Response
     */
    public function new(Request $request, $pageid)
    {
        $article = new Article();

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($article);
            $this->em->flush();
            $this->addFlash('success', 'Un nouvel article a été ajouté');
            return $this->redirectToRoute('admin.content.basic_page.edit', [
                'current_menu' => 'Contenu',
                'id' => $pageid
            ]);
        }

        return $this->render('admin/content/page_content/articles/new.html.twig', [
            'current_menu' => 'Contenu',
            'form' => $form->createView(),
            'pageid' => $pageid
        ]);
    }

    /**
     * @Route("/admin/contenu/page/{pageid}/article/edit/{articleid}", name="admin.content.article.edit", methods="GET|POST")
     * @return Response
     */
    public function edit($articleid, $pageid, Request $request)
    {
        $article = $this->articleRepository->findOneBy(['id' => $articleid]);
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'L\'article a été modifié avec succès');
            return $this->redirectToRoute('admin.content.basic_page.edit', ['id' => $pageid]);
        }

        return $this->render('admin/content/page_content/articles/edit.html.twig', [
            'article' => $article,
            'current_menu' => 'Contenu',
            'form' => $form->createView(),
            'pageid' => $pageid
        ]);
    }

    /**
     * @Route("/admin/content/page/{pageid}/article/delete/{articleid}", name="admin.content.article.delete", methods="DELETE")
     * @return Response
     */
    public function delete($articleid, $pageid, Request $request)
    {
        $article = $this->articleRepository->findOneBy(['id' => $articleid]);
        if($this->isCsrfTokenValid('delete' . $article->getID(), $request->get('_token')))
        {
            $this->em->remove($article);
            $this->em->flush();
            $this->addFlash('success', 'Article supprimé avec succès');
        }

        return $this->redirectToRoute('admin.content.basic_page.edit', ['id' => $pageid]);
    }
}