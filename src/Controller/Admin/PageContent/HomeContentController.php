<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\SiteHomePageCarousel;
use App\Form\Admin\PageContent\HomePageCarouselFormType;
use App\Repository\SiteHomePageCarouselRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeContentController extends AbstractController
{
    /**
     * @var SiteHomePageCarouselRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(SiteHomePageCarouselRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/content/home_page", name="admin.content.home_page")
     */
    public function index()
    {
        $current_user = $this->getUser();
        $homeCarouselData = $this->repository->findAll();

        return $this->render('admin/content/home_page.html.twig', [
            'current_menu' => 'contenu',
            'current_user' => $current_user,
            'home_carousel_data' => $homeCarouselData,
        ]);
    }

    /**
     * @Route("/admin/content/home_carousel_item/new", name="content.home_carousel_item.new")
     * @return Response
     */
    public function homeCarouselNew(Request $request)
    {
        $current_user = $this->getUser();
        $carousel = new SiteHomePageCarousel();

        $form = $this->createForm(HomePageCarouselFormType::class, $carousel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($carousel);
            $this->em->flush();
            $this->addFlash('success', 'Un nouvel item a été ajouté au carousel');
            return $this->redirectToRoute('admin.content.home_page', [
                'current_menu' => 'contenu'
            ]);
        }

        return $this->render('admin/content/home_carousel_new.html.twig', [
            'current_menu' => 'contenu',
            'current_user' => $current_user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/home_carousel_item/edit/{id}", name="content.home_carousel_item.edit", methods="GET|POST")
     * @param SiteHomePageCarousel $carousel
     * @return Response
     */
    public function homeCarouselEdit(SiteHomePageCarousel $carousel, Request $request)
    {
        $currentUser = $this->getUser();
        $form = $this->createForm(HomePageCarouselFormType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La bannière principale a été modifiée');
            return $this->redirectToRoute('admin.content.home_page');
        }

        return $this->render('admin/content/home_carousel_edit.html.twig', [
            'carousel' => $carousel,
            'current_menu' => 'contenu',
            'form' => $form->createView(),
            'current_user' => $currentUser,
        ]);
    }

    /**
     * @Route("/admin/content/home_carousel_item/delete/{id}", name="content.home_carousel_item.delete", methods="DELETE")
     * @param SiteHomePageCarousel $carousel
     * @return Response
     */
    public function homeCarouselDelete(SiteHomePageCarousel $carousel, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $carousel->getID(), $request->get('_token')))
        {
            $this->em->remove($carousel);
            $this->em->flush();
            $this->addFlash('success', 'Elément supprimé de la bannière principale');
        }

        return $this->redirectToRoute('admin.content.home_page');
    }

}