<?php

namespace App\DataFixtures;

use App\Entity\Document;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DocumentFixtures extends Fixture
{
    private $doi = ['10.3352/jeehp.2013.10.3','10.2991/jnmp.2006.13.4.1','10.1109/5.771073',' 10.1016/S8756-3282(01)00704-9'];
    private $title = ['Revision of the instructions to authors to require a structured abstract, digital object identifier of each reference, and author’s voice recording may increase journal access',
        'G 2-Calogero-Moser Lax operators from reduction','Toward unique identifiers','Bone mineral density of competitive male mountain and road cyclists'];
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {

           // $number=random_int(0, 3);
            $document = new Document();
            $document->setDoi($this->doi[$i])
                ->setTitle($this->title[$i]);
            $manager->persist($document);
        }

        $manager->flush();
    }
}
