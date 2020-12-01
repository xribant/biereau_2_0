<?php


namespace App\Controller\Admin\Member;


use App\Entity\Member;
use App\Form\MemberFormType;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @var Member
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(MemberRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/ecole/staff", name="admin.ecole.staff")
     */
    public function index()
    {
        $members = $this->repository->findAll();

        return $this->render('admin/school/staff/index.html.twig', [
            'current_menu' => 'schoolData',
            'members' => $members,
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/new", name="admin.ecole.staff.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $member = new Member();

        $form = $this->createForm(MemberFormType::class, $member);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($member);
            $this->em->flush();
            $this->addFlash('success', 'Une nouveau membre a ét ajouté à l\'équipe');
            return $this->redirectToRoute('admin.ecole.staff', [
                'current_menu' => 'schoolData'
            ]);
        }

        return $this->render('admin/school/staff/new.html.twig', [
            'current_menu' => 'schoolData',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/edit/{id}", name="admin.ecole.staff.edit", methods="GET|POST")
     * @param Member $member
     * @return Response
     */
    public function edit(Member $member, Request $request)
    {
        $form = $this->createForm(MemberFormType::class, $member);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Le membre a été modifiée avec succès');
            return $this->redirectToRoute('admin.ecole.staff');
        }

        return $this->render('admin/school/staff/edit.html.twig', [
            'member' => $member,
            'current_menu' => 'schoolData',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ecole/staff/delete/{id}", name="admin.ecole.staff.delete", methods="DELETE")
     * @param Member $member
     * @return Response
     */
    public function delete(Member $member, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $member->getID(), $request->get('_token')))
        {
            $this->em->remove($member);
            $this->em->flush();
            $this->addFlash('success', 'Membre supprimé avec succès');
        }

        return $this->redirectToRoute('admin.ecole.staff');
    }
}