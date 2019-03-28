<?php

namespace App\DataFixtures;

use App\Entity\Contributor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContributorFixtures extends Fixture
{
    private $civil = ['Mr','Mme','Mademoiselle'];
    private $name = ['Paskin','Fring','Nenad','Sun'];
    private $lastname = ['Norman','Andrias','Manojlovic','Huh'];
    private $complement = ['N.Paksin','A.Fring','N.Manojlovic','Sun.H'];
    private $mail = ['paskin.nikolas@doi.org','afring@city.ac.uk','nmanoj@ualg.pt','shuh@hallym.ac.kr'];
    private $login = ['log123','log456','log789',''];
    private $pwd = ['0000','1111','2222','3333'];
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        /**
         * Adding 5 new Contributors To the Contributor Table
         */
        for ($i = 0; $i < 4; $i++) {
            //$number=random_int(0, 3);
            $contributor = new Contributor();
            $contributor->setCivilite($this->civil[0])
                     ->setNom($this->name[$i])
                     ->setComplementNom($this->complement[$i])
                      ->setPrenom($this->lastname[$i])
                      ->setEmail($this->mail[$i])
                      ->setIsAdmin($i)
                       ->setLogin($this->login[$i])
                       ->setPwd($this->pwd[$i])
                      ->setPhoto('http://placekitten.com/200/300');
            $manager->persist($contributor);
        }
        $manager->flush();
    }
}
