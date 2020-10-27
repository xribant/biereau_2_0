<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\SchoolData;

class SchoolDataFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $data = new SchoolData();

        $data->setName('Collège du Biéreau');
        $data->setStreet('Rue du collège');
        $data->setStreetNum('2');
        $data->setPostalCode(1348);
        $data->setCity('Ottignies-Louvain-La-Neuve');
        $data->setPhone1('010.45.03.06');
        $data->setPhone2('');
        $data->setEmail1('direction@biereau.be');
        $data->setEmail2('secretariat@biereau.be');

        $manager->persist($data);
        $manager->flush();
    }
}
