<?php


namespace App\Controller\Admin\PageContent;


use App\Entity\RegistrationContent;
use App\Entity\RegistrationStep;
use App\Form\RegistrationContentAlertFormType;
use App\Form\RegistrationContentIntroFormType;
use App\Form\RegistrationStepFormType;
use App\Repository\RegistrationContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/contenu/pages/inscription")
 */
class RegistrationContentController extends AbstractController
{
    /**
     * @var RegistrationContent
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(RegistrationContentRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/afficher", name="admin.content.registration_page.index", methods="GET|POST")
     * @return Response
     */
    public function index() {

        $registrationContent = $this->repository->findOneBy(['id' => 1]);

        return $this->render('admin/content/registration/index.html.twig', [
            'registrationContent' => $registrationContent,
            'current_menu' => 'contenu',
        ]);
    }

    /**
     * @Route("/alerte/editer", name="admin.content.registration.alert.edit")
     */
    public function registrationContentAlertEdit(Request $request) {
        $registrationContent = $this->repository->findOneBy(['id' => 1]);

        $form = $this->createForm(RegistrationContentAlertFormType::class, $registrationContent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La page d\'inscription a été modifiée avec succès');
            return $this->redirectToRoute('admin.content.registration_page.index');
        }

        return $this->render('admin/content/registration/alert_edit.html.twig', [
            'registrationContent' => $registrationContent,
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/intro/editer", name="admin.content.registration.intro.edit")
     */
    public function registrationContentIntroEdit(Request $request) {
        $registrationContent = $this->repository->findOneBy(['id' => 1]);

        $form = $this->createForm(RegistrationContentIntroFormType::class, $registrationContent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La page d\'inscription a été modifiée avec succès');
            return $this->redirectToRoute('admin.content.registration_page.index');
        }

        return $this->render('admin/content/registration/intro_edit.html.twig', [
            'registrationContent' => $registrationContent,
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/processus/etapes/ajouter", name="admin.content.registrationStep.new")
     */
    public function registrationStepAdd(Request $request) {

        $step = new RegistrationStep();
        $page = $this->repository->findOneBy(['id' => 1]);

        $form = $this->createForm(RegistrationStepFormType::class, $step);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $step->setRegistrationPage($page);
            $this->em->persist($step);
            $this->em->flush();
            $this->addFlash('success', 'Cette étape du processus a été créé avec succès');
            return $this->redirectToRoute('admin.content.registration_page.index');
        }

        return $this->render('admin/content/registration/step_add.html.twig', [
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/processus/etapes/modifier/{id}", name="admin.content.registrationStep.edit")
     */
    public function registrationStepEdit(RegistrationStep $registrationStep, Request $request) {

        $form = $this->createForm(RegistrationStepFormType::class, $registrationStep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Cette étape du processus a été créé avec succès');
            return $this->redirectToRoute('admin.content.registration_page.index');
        }

        return $this->render('admin/content/registration/step_edit.html.twig', [
            'current_menu' => 'contenu',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/processus/etapes/supprimer/{id}", name="admin.content.registrationStep.delete", methods="DELETE")
     */
    public function registrationStepDelete(RegistrationStep $registrationStep, Request $request) {

        if($this->isCsrfTokenValid('delete' . $registrationStep->getID(), $request->get('_token')))
        {
            $this->em->remove($registrationStep);
            $this->em->flush();
            $this->addFlash('success', 'Etape supprimée avec succès');
        }

        return $this->redirectToRoute('admin.content.registration_page.index');
    }

}