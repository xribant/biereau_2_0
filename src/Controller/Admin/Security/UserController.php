<?php


namespace App\Controller\Admin\Security;

use App\Entity\User;
use App\Form\Admin\UserType;
use App\Notification\ContactNotification;
use App\Notification\PasswordNotification;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    private $encoder;

    public function __construct(UserRepository $repository, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->encoder = $encoder;
    }

    /**
     * @Route("/admin/users/list", name="admin.users.index")
     */
    public function index()
    {
        $users = $this->repository->findAll();

        return $this->render('/admin/security/users/index.html.twig', [
            'current_menu' => 'users',
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/users/nouveau", name="admin.users.new")
     * @return Response
     */
    public function new(Request $request,  PasswordNotification $notification)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $generator = new ComputerPasswordGenerator();

            $generator
                ->setUppercase()
                ->setLowercase()
                ->setNumbers()
                ->setSymbols(false)
                ->setLength(10)
            ;

            $password = $generator->generatePassword();
            $user->setPassword($password);
            $notification->notify($user);

            $user->setPassword($this->encoder->encodePassword($user, $password));

            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('success', 'Un nouvel utilisateur a été ajouté');
            return $this->redirectToRoute('admin.users.index');
        }

        return $this->render('admin/security/users/new.html.twig', [
            'user' => $user,
            'current_menu' => 'users',
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/admin/users/modifier/{id}", name="admin.users.edit", methods="GET|POST")
     * @param User $user
     * @return Response
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'L\'utilisateur a été modifié avec succès');
            return $this->redirectToRoute('admin.users.index');
        }

        return $this->render('admin/security/users/edit.html.twig', [
            'user' => $user,
            'current_menu' => 'users',
            'form' => $form->createView(),
        ]);
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