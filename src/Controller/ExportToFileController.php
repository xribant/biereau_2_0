<?php


namespace App\Controller;


use App\Repository\ContactSubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/export")
 */
class ExportToFileController extends AbstractController
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
     * @Route("/", name="export.registrations", methods={"GET"})
     */
    public function exportToExcel() {

        $registrants = $this->repository->findAll();

        $spreadsheet = new Spreadsheet();

        setlocale(LC_TIME, "fr_BE");

        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle("Liste des inscritpions");

        $sheet->setCellValue('A1', 'Date d\'inscription');
        $sheet->setCellValue('B1', 'Nom');
        $sheet->setCellValue('C1', 'Prénom');
        $sheet->setCellValue('D1', 'Téléphone');
        $sheet->setCellValue('E1', 'E-Mail');
        $sheet->setCellValue('F1', 'Prénom de l\'enfant');
        $sheet->setCellValue('G1', 'Nom de l\'enfant');
        $sheet->setCellValue('H1', 'Date de naissance');
        $sheet->setCellValue('I1', 'Section');
        $sheet->setCellValue('J1', 'Séance d\'info');

        $i = 2;
        foreach($registrants as $user) {
            $sheet->setCellValue('A'.$i, $user->getCreatedAt()->format('d-m-Y H:i:s'));
            $sheet->setCellValue('B'.$i, $user->getParentLastName());
            $sheet->setCellValue('C'.$i, $user->getParentFirstName());
            $sheet->setCellValue('D'.$i, $user->getParentPhone());
            $sheet->setCellValue('E'.$i, $user->getParentEmail());
            $sheet->setCellValue('F'.$i, $user->getChildFirstName());
            $sheet->setCellValue('G'.$i, $user->getChildLastName());
            $sheet->setCellValue('H'.$i, $user->getChildBirthDate()->format('d-m-Y'));
            $sheet->setCellValue('I'.$i, $user->getChildSection());
            $sheet->setCellValue('J'.$i, $user->getSessionDate()->format('d-m-Y'));
            $i++;
        }

        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);

        // Create a Temporary file in the system
        $fileName = 'liste_inscriptions_'.date("d_m_Y").'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }
}