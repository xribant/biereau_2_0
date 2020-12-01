<?php


namespace App\Controller\Admin\NavMenu;


use App\Entity\NavMenu;
use App\Entity\News;
use App\Entity\SubMenu;
use App\Form\NavMenuType;
use App\Form\SubMenuType;
use App\Repository\NavMenuRepository;
use App\Repository\SubMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavMenuController extends AbstractController
{
    /**
     * @var NavMenu
     */
    private $navMenuRepository;

    /**
     * @var SubMenu
     */
    private $subMenuRepository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(NavMenuRepository $navMenuRepository, SubMenuRepository $subMenuRepository, EntityManagerInterface $em)
    {
        $this->navMenuRepository = $navMenuRepository;
        $this->subMenuRepository = $subMenuRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/content/menu/nav_menu", name="admin.content.nav_menu")
     */
    public function indexNavMenu()
    {
        $navMenu = $this->navMenuRepository->findAll();

        return $this->render('admin/content/menu/nav_menu.html.twig', [
            'current_menu' => 'menus',
            'navMenu' => $navMenu,
        ]);
    }

    /**
     * @Route("/admin/content/menu/sub_menu", name="admin.content.sub_menu")
     */
    public function indexSubMenu()
    {
        $subMenu = $this->subMenuRepository->findAllOrderedByNavMenu();

        return $this->render('admin/content/menu/sub_menu.html.twig', [
            'current_menu' => 'menus',
            'subMenu' => $subMenu,
        ]);
    }

    /**
     * @Route("/admin/content/menu/nav_menu/new", name="admin.content.nav_menu.new")
     * @return Response
     */
    public function navMenuNew(Request $request)
    {
        $navMenu = new NavMenu();

        $form = $this->createForm(NavMenuType::class, $navMenu);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($navMenu);
            $this->em->flush();
            $this->addFlash('success', 'Un nouvel élément du menu de navigation a été ajouté');
            return $this->redirectToRoute('admin.content.nav_menu', [
                'current_menu' => 'contenu'
            ]);
        }

        return $this->render('admin/content/menu/nav_menu_new.html.twig', [
            'current_menu' => 'menus',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/menu/nav_menu/edit/{id}", name="admin.content.nav_menu.edit", methods="GET|POST")
     * @param NavMenu $navMenu
     * @return Response
     */
    public function navMenuEdit(NavMenu $navMenu, Request $request)
    {
        $form = $this->createForm(NavMenuType::class, $navMenu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'L\'élément de menu a été modifié avec succès');
            return $this->redirectToRoute('admin.content.nav_menu');
        }

        return $this->render('admin/content/menu/nav_menu_edit.html.twig', [
            'navMenu' => $navMenu,
            'current_menu' => 'menus',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/menu/nav_menu/delete/{id}", name="admin.content.nav_menu.delete", methods="DELETE")
     * @param NavMenu $navMenu
     * @return Response
     */
    public function navMenuDelete(NavMenu $navMenu, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $navMenu->getID(), $request->get('_token')))
        {
            $this->em->remove($navMenu);
            $this->em->flush();
            $this->addFlash('success', 'Elément de menu supprimé avec succès');
        }

        return $this->redirectToRoute('admin.content.nav_menu');
    }

    /**
     * @Route("/admin/content/menu/sub_menu/new", name="admin.content.sub_menu.new")
     * @return Response
     */
    public function subMenuNew(Request $request, NavMenuRepository $navMenuRepository)
    {
        $subMenu = new SubMenu();

        $form = $this->createForm(SubMenuType::class, $subMenu);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($subMenu);
            $this->em->flush();
            $this->addFlash('success', 'Un nouveau sous-menu de navigation a été ajouté');
            return $this->redirectToRoute('admin.content.sub_menu', [
                'current_menu' => 'contenu'
            ]);
        }

        return $this->render('admin/content/menu/sub_menu_new.html.twig', [
            'current_menu' => 'menus',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/menu/sub_menu/edit/{id}", name="admin.content.sub_menu.edit", methods="GET|POST")
     * @param SubMenu $subMenu
     * @return Response
     */
    public function subMenuEdit(SubMenu $subMenu, Request $request)
    {
        $form = $this->createForm(SubMenuType::class, $subMenu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'L\'élément de menu a été modifié avec succès');
            return $this->redirectToRoute('admin.content.sub_menu');
        }

        return $this->render('admin/content/menu/sub_menu_edit.html.twig', [
            'subMenu' => $subMenu,
            'current_menu' => 'menus',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/content/menu/sub_menu/delete/{id}", name="admin.content.sub_menu.delete", methods="DELETE")
     * @param SubMenu $subMenu
     * @return Response
     */
    public function subMenuDelete(SubMenu $subMenu, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $subMenu->getID(), $request->get('_token')))
        {
            $this->em->remove($subMenu);
            $this->em->flush();
            $this->addFlash('success', 'Elément de menu supprimé avec succès');
        }

        return $this->redirectToRoute('admin.content.sub_menu');
    }
}