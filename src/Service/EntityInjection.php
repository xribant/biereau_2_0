<?php


namespace App\Service;


use App\Repository\BasicPageRepository;
use App\Repository\SchoolDataRepository;

class EntityInjection
{
    /**
     * @var BasicPageRepository
     */
    private $basicPageRepository;
    /**
     * @var SchoolDataRepository
     */
    private $schoolDataRepository;

    public function __construct(BasicPageRepository $basicPageRepository, SchoolDataRepository $schoolDataRepository) {
        $this->basicPageRepository = $basicPageRepository;
        $this->schoolDataRepository = $schoolDataRepository;
    }

    public function getFirstBasicPage()
    {
        $firstBasicPage = $this->basicPageRepository->findFirst();
        return $firstBasicPage;
    }

    public function getAllBasicPages()
    {
        $allBasicPages = $this->basicPageRepository->findAll();
        return $allBasicPages;
    }

    public function getSchoolData()
    {
        $schoolData = $this->schoolDataRepository->findOneBy(['id' => 1]);
        return $schoolData;
    }
}