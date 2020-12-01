<?php


namespace App\Controller\Admin\Member;


use App\Entity\Fonction;
use App\Form\FonctionFormType;
use App\Repository\FonctionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FonctionController extends AbstractController
{
    /**
     * @var Fonction
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(FonctionRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/ecole/staff/fonction", name="admin.ecole.staff.fonction")
     */
    public function index()
    {
        $fonctions = $this->repository->findAll();

        return $this->render('admin/school/staff/fonctions/index.html.twig', [
            'current_menu' => 'schoolData',
            'fonctions' => $fonctions,
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/fonction/new", name="admin.ecole.staff.fonction.new")
     * @return Response
     */
    public function new(Request $request){
        $fonction = new Fonction();

        $form = $this->createForm(FonctionFormType::class, $fonction);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($fonction);
            $this->em->flush();
            $this->addFlash('success', 'Une nouvelle fonction a été ajoutée');
            return $this->redirectToRoute('admin.ecole.staff.fonction', [
                'current_menu' => 'ecole'
            ]);
        }

        return $this->render('admin/school/staff/fonctions/new.html.twig', [
            'current_menu' => 'schoolData',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/fonction/edit/{id}", name="admin.ecole.staff.fonction.edit", methods="GET|POST")
     * @param Fonction $fonction
     * @return Response
     */
    public function edit(Fonction $fonction, Request $request)
    {
        $form = $this->createForm(FonctionFormType::class, $fonction);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La fonction a été modifiée avec succès');
            return $this->redirectToRoute('admin.ecole.staff.fonction');
        }

        return $this->render('admin/school/staff/fonctions/edit.html.twig', [
            'fonction' => $fonction,
            'current_menu' => 'schoolData',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/fonction/delete/{id}", name="admin.ecole.staff.fonction.delete", methods="DELETE")
     * @param Fonction $fonction
     * @return Response
     */
    public function delete(Fonction $fonction, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $fonction->getID(), $request->get('_token')))
        {
            $this->em->remove($fonction);
            $this->em->flush();
            $this->addFlash('success', 'Fonction supprimée avec succès');
        }

        return $this->redirectToRoute('admin.ecole.staff.fonction');
    }
}