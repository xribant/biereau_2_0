<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\Pageintro;
use App\Form\PageIntroFormType;
use App\Repository\PageintroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageIntroController extends AbstractController
{
    /**
     * @var Pageintro
     */
    private $pageintroRepository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PageintroRepository $pageintroRepository, EntityManagerInterface $em)
    {
        $this->pageintroRepository = $pageintroRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/content/page/{pageid}/intro/new", name="admin.content.page_intro.new")
     * @return Response
     */
    public function new($pageid, Request $request)
    {
        $intro = new Pageintro();

        $form = $this->createForm(PageIntroFormType::class, $intro);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($intro);
            $this->em->flush();
            $this->addFlash('success', 'Un nouveau texte d\'introduction a été ajouté');
            return $this->redirectToRoute('admin.content.basic_page.edit', [
                'current_menu' => 'contenu',
                'id' => $pageid,
            ]);
        }

        return $this->render('admin/content/page_content/intro/new.html.twig', [
            'current_menu' => 'contenu',
            'form' => $form->createView(),
            'pageid' => $pageid,
        ]);
    }

    /**
     * @Route("/admin/contenu/page/{pageid}/intro/edit/{introid}", name="admin.content.intro.edit", methods="GET|POST")
     * @return Response
     */
    public function edit(Request $request, $introid, $pageid)
    {
        $intro = $this->pageintroRepository->findOneBy(['id' => $introid]);
        $form = $this->createForm(PageIntroFormType::class, $intro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'L\'article d\'introduction a été modifié avec succès');
            return $this->redirectToRoute('admin.content.basic_page.edit', ['id' => $pageid]);
        }

        return $this->render('admin/content/page_content/intro/edit.html.twig', [
            'intro' => $intro,
            'current_menu' => 'Contenu',
            'form' => $form->createView(),
            'pageid' => $pageid,
        ]);
    }

    /**
     * @Route("/admin/content/page/{pageid}/intro/delete/{introid}", name="admin.content.intro.delete", methods="DELETE")
     * @return Response
     */
    public function delete($pageid, $introid, Request $request)
    {
        $intro = $this->pageintroRepository->findOneBy(['id' => $introid]);

        if($this->isCsrfTokenValid('delete' . $intro->getID(), $request->get('_token')))
        {
            $this->em->remove($intro);
            $this->em->flush();
            $this->addFlash('success', 'Article d\'intro supprimé avec succès');
        }

        return $this->redirectToRoute('admin.content.basic_page.edit', ['id' => $pageid]);
    }
}