<?php


namespace App\Controller\Admin\Member;


use App\Entity\StaffGroup;
use App\Form\StaffGroupFormType;
use App\Repository\StaffGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaffGroupController extends AbstractController
{
    /**
     * @var StaffGroup
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(StaffGroupRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/ecole/staff/group", name="admin.ecole.staff.group")
     */
    public function index()
    {
        $groups = $this->repository->findAll();

        return $this->render('admin/school/staff/groups/index.html.twig', [
            'current_menu' => 'schoolData',
            'groups' => $groups,
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/group/new", name="admin.ecole.staff.group.new")
     * @return Response
     */
    public function new(Request $request){
        $group = new StaffGroup();

        $form = $this->createForm(StaffGroupFormType::class, $group);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($group);
            $this->em->flush();
            $this->addFlash('success', 'Un nouveau groupe de fonctions a été ajouté avec succès');
            return $this->redirectToRoute('admin.ecole.staff.group', [
                'current_menu' => 'ecole'
            ]);
        }

        return $this->render('admin/school/staff/groups/new.html.twig', [
            'current_menu' => 'schoolData',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/group/edit/{id}", name="admin.ecole.staff.group.edit", methods="GET|POST")
     * @param StaffGroup $group
     * @return Response
     */
    public function edit(StaffGroup $group, Request $request)
    {
        $form = $this->createForm(StaffGroupFormType::class, $group);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Le groupe a été modifié avec succès');
            return $this->redirectToRoute('admin.ecole.staff.group');
        }

        return $this->render('admin/school/staff/groups/edit.html.twig', [
            'group' => $group,
            'current_menu' => 'schoolData',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/group/delete/{id}", name="admin.ecole.staff.group.delete", methods="DELETE")
     * @param StaffGroup $group
     * @return Response
     */
    public function delete(StaffGroup $group, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $group->getID(), $request->get('_token')))
        {
            $this->em->remove($group);
            $this->em->flush();
            $this->addFlash('success', 'Groupe supprimé avec succès');
        }

        return $this->redirectToRoute('admin.ecole.staff.group');
    }
}