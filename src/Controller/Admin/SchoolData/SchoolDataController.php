<?php


namespace App\Controller\Admin\SchoolData;

use App\Entity\SchoolData;
use App\Form\Admin\School\SchoolDataType;
use App\Repository\SchoolDataRepository;
use App\Repository\SchoolSectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class SchoolDataController extends AbstractController
{

    /**
     * @var SchoolDataRepository
     */
    private $schoolDataRepo;

    /**
     * @var SchoolSectionRepository
     */
    private $schoolSectionRepo;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(SchoolDataRepository $schoolDataRepo, SchoolSectionRepository $schoolSectionRepo, EntityManagerInterface $em)
    {
        $this->schoolDataRepo = $schoolDataRepo;
        $this->schoolSectionRepo = $schoolSectionRepo;
        $this->em = $em;
    }

    /**
     * @Route("/admin/ecole/details", name="admin.schoolData.index");
     * @return Response
     */
    public function index()
    {
        $currentUser = $this->getUser();
        $school = $this->schoolDataRepo->findOneBy(['id' => 1]);
        $section = $this->schoolSectionRepo->findAll();

        return $this->render('/admin/school/data/index.html.twig', [
            'current_user' => $currentUser,
            'school' => $school,
            'sections' => $section,
            'current_menu' => 'schoolData'
        ]);
    }

    /**
     * @Route("/admin/ecole/details/modification", name="admin.schoolData.edit")
     * @return Response
     */
    public function edit(Request $request)
    {
        $currentUser = $this->getUser();
        $school = $this->schoolDataRepo->findOneBy(['id' => 1]);
        $form = $this->createForm(SchoolDataType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Détails de l\'école modifiés avec succès');
            return $this->redirectToRoute('admin.schoolData.index');
        }

        return $this->render('admin/school/data/edit.html.twig', [
            'current_user' => $currentUser,
            'school' => $school,
            'form' => $form->createView(),
            'current_menu' => 'schoolData'
        ]);
    }

}