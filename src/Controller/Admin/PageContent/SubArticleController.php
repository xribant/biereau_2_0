<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\Article;
use App\Entity\SubArticle;
use App\Form\SubArticleFormType;
use App\Repository\ArticleRepository;
use App\Repository\BasicPageRepository;
use App\Repository\SubArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SubArticleController extends AbstractController
{
    /**
     * @var SubArticle
     */
    private $SubArticleRepository;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var BasicPageRepository
     */
    private $basicPageRepository;

    public function __construct(SubArticleRepository $SubArticleRepository, EntityManagerInterface $em, BasicPageRepository $basicPageRepository)
    {
        $this->SubArticleRepository = $SubArticleRepository;
        $this->em = $em;
        $this->basicPageRepository = $basicPageRepository;
    }

    /**
     * @Route("/admin/contenu/sub-article/new", name="admin.content.sub_article.new")
     * @param SubArticle $subArticle
     * @return Response
     */
    public function new(Request $request)
    {
        $subArticle = new SubArticle();

        $form = $this->createForm(SubArticleFormType::class, $subArticle);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($subArticle);
            $this->em->flush();
            $this->addFlash('success', 'Un nouveau sous-article a été ajouté');
            return $this->redirectToRoute('admin.content.basic_page.index', [
                'current_menu' => 'Contenu',
            ]);
        }

        return $this->render('admin/content/page_content/sub_article/new.html.twig', [
            'current_menu' => 'Contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/contenu/sub-article/edit/{id}", name="admin.content.sub_article.edit", methods="GET|POST")
     * @var SubArticle $subArticle
     * @return Response
     */
    public function edit(Request $request, SubArticle $subArticle, $id)
    {
        $form = $this->createForm(SubArticleFormType::class, $subArticle);
        $form->handleRequest($request);
        $subArticle = $this->SubArticleRepository->findOneBy(['id' => $id]);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Le sous-article a été modifié avec succès');
            return $this->redirectToRoute('admin.content.basic_page.index');
        }

        return $this->render('admin/content/page_content/sub_article/edit.html.twig', [
            'subArticle' => $subArticle,
            'current_menu' => 'Contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/sub-article/delete/{id}", name="admin.content.sub_article.delete", methods="DELETE")
     * @var SubArticle $subArticle
     * @return Response
     */
    public function delete(Request $request, SubArticle $subArticle)
    {
        if($this->isCsrfTokenValid('delete' . $subArticle->getID(), $request->get('_token')))
        {
            $this->em->remove($subArticle);
            $this->em->flush();
            $this->addFlash('success', 'Sous-article supprimé avec succès');
        }

        return $this->redirectToRoute('admin.content.basic_page.index');
    }
}