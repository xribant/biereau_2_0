<?php


namespace App\Controller\Admin\Security;

use App\Entity\User;
use App\Form\Admin\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(UserRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/users", name="admin.users.index")
     */
    public function index()
    {
        $currentUser = $this ->getUser();
        $users = $this->repository->findAll();

        return $this->render('/admin/security/users/index.html.twig', [
            'current_menu' => 'users',
            'current_user' => $currentUser,
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/users/nouveau", name="admin.users.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $currentUser = $this->getUser();

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Un nouvel utilisateur a été ajouté');
            return $this->redirectToRoute('admin.users.index');
        }

        return $this->render('admin/security/users/new.html.twig', [
            'user' => $user,
            'current_menu' => 'users',
            'form' => $form->createView(),
            'current_user' => $currentUser,
        ]);

    }

    /**
     * @Route("/admin/users/modifier/{id}", name="admin.users.edit", methods="GET|POST")
     * @param User $user
     * @return Response
     */
    public function edit()
    {

    }

    /**
     *
     * @Route("/admin/users/delete/{id}", name="admin.users.delete", methods="DELETE")
     * @param User $user
     * @return Response
     */
    public function delete(User $user, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $user->getID(), $request->get('_token')))
        {
            $this->em->remove($user);
            $this->em->flush();
            $this->addFlash('success', 'Utilisateur supprimé avec succès');
        }

        return $this->redirectToRoute('admin.users.index');
    }
}