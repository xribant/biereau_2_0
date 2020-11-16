<?php


namespace App\Controller\Admin\Pages;


use App\Entity\BasicPage;
use App\Form\BasicPageFormType;
use App\Repository\BasicPageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasicPageController extends AbstractController
{
    /**
     * @var BasicPage
     */
    private $basicPageRepository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(BasicPageRepository $basicPageRepository, EntityManagerInterface $em)
    {
        $this->basicPageRepository = $basicPageRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/pages", name="admin.pages.index")
     */
    public function index()
    {
        $current_user = $this->getUser();
        $pages = $this->basicPageRepository->findAll();

        return $this->render('admin/pages/index.html.twig', [
            'current_menu' => 'Pages',
            'current_user' => $current_user,
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("/admin/pages/new", name="admin.pages.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $current_user = $this->getUser();
        $page = new BasicPage();

        $form = $this->createForm(BasicPageFormType::class, $page);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($page);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle page a été générée');
            return $this->redirectToRoute('admin.pages.index', [
                'current_menu' => 'Pages'
            ]);
        }

        return $this->render('admin/pages/new.html.twig', [
            'current_menu' => 'Pages',
            'current_user' => $current_user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/pages/edit/{id}", name="admin.pages.edit", methods="GET|POST")
     * @param basicPage $page
     * @return Response
     */
    public function edit(BasicPage $page, Request $request)
    {
        $currentUser = $this->getUser();
        $form = $this->createForm(BasicPageFormType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La page a été modifiée avec succès');
            return $this->redirectToRoute('admin.pages.index');
        }

        return $this->render('admin/pages/edit.html.twig', [
            'page' => $page,
            'current_menu' => 'Pages',
            'form' => $form->createView(),
            'current_user' => $currentUser,
        ]);
    }

    /**
     * @Route("/admin/pages/delete/{id}", name="admin.pages.delete", methods="DELETE")
     * @param BasicPage $page
     * @return Response
     */
    public function delete(BasicPage $page, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $page->getID(), $request->get('_token')))
        {
            $this->em->remove($page);
            $this->em->flush();
            $this->addFlash('success', 'Page supprimée avec succès');
        }

        return $this->redirectToRoute('admin.pages.delete');
    }


}