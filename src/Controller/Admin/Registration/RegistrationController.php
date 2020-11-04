<?php


namespace App\Controller\Admin\Registration;


use App\Entity\ContactSub;
use App\Repository\ContactSubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @var ContactSubRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;


    public function __construct(ContactSubRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/inscriptions/liste", name="admin.registrations.show");
     */
    public function index()
    {
        $registrants = $this->repository->findAll();


        $currentUser = $this->getUser();
        return $this->render('/admin/school/registration/view.html.twig',[
            'current_user' => $currentUser,
            'registrants' => $registrants,
            'current_menu' => 'inscriptions'
        ]);
    }


}