<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\SiteHomePageCarousel;
use App\Form\Admin\PageContent\HomePageCarouselFormType;
use App\Repository\SchoolValueRepository;
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
    /**
     * @var SchoolValueRepository
     */
    private $schoolValueRepository;

    public function __construct(SiteHomePageCarouselRepository $repository, SchoolValueRepository $schoolValueRepository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->schoolValueRepository = $schoolValueRepository;
    }

    /* ------------------------------------- Carousel controller -------------------------------------------------*/

    /**
     * @Route("/admin/content/home_carousel", name="admin.content.home_carousel")
     */
    public function index()
    {
        $current_user = $this->getUser();
        $homeCarouselData = $this->repository->findAll();
        $schoolValues = $this->schoolValueRepository->findAll();

        return $this->render('admin/content/home_carousel/index.html.twig', [
            'current_menu' => 'contenu',
            'current_user' => $current_user,
            'home_carousel_data' => $homeCarouselData,
            'school_values' => $schoolValues,
        ]);
    }

    /**
     * @Route("/admin/content/home_carousel/new", name="admin.content.home_carousel.new")
     * @return Response
     */
    public function new(Request $request)
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
            return $this->redirectToRoute('admin.content.home_carousel', [
                'current_menu' => 'contenu'
            ]);
        }

        return $this->render('admin/content/home_carousel/new.html.twig', [
            'current_menu' => 'contenu',
            'current_user' => $current_user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/home_carousel/edit/{id}", name="admin.content.home_carousel.edit", methods="GET|POST")
     * @param SiteHomePageCarousel $carousel
     * @return Response
     */
    public function edit(SiteHomePageCarousel $carousel, Request $request)
    {
        $currentUser = $this->getUser();
        $form = $this->createForm(HomePageCarouselFormType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La bannière principale a été modifiée');
            return $this->redirectToRoute('admin.content.home_carousel');
        }

        return $this->render('admin/content/home_carousel/edit.html.twig', [
            'carousel' => $carousel,
            'current_menu' => 'contenu',
            'form' => $form->createView(),
            'current_user' => $currentUser,
        ]);
    }

    /**
     * @Route("/admin/content/home_carousel/delete/{id}", name="admin.content.home_carousel.delete", methods="DELETE")
     * @param SiteHomePageCarousel $carousel
     * @return Response
     */
    public function delete(SiteHomePageCarousel $carousel, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $carousel->getID(), $request->get('_token')))
        {
            $this->em->remove($carousel);
            $this->em->flush();
            $this->addFlash('success', 'Elément supprimé de la bannière principale');
        }

        return $this->redirectToRoute('admin.content.home_carousel');
    }

}