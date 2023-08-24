<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Client;
use App\Entity\Disc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $c1 = new Client();
        $c1->setNom("toto");
        $c1->setPrenom("titi");

        $manager->persist($c1);


        $c2 = new Client();
        $c2->setNom("tutu");
        $c2->setPrenom("tata");

        $manager->persist($c2);

        $a1 = new Artist();
        $a1->setName("tutu");
        $a1->setUrl("tata");
        $manager->persist($a1);


        $d1 = new Disc();
        $d1->setTitle("tutu");
        $d1->setPicture("tata");
        $d1->setArtist($a1);
        $manager->persist($d1);

        $d2 = new Disc();
        $d2->setTitle("tutu2");
        $d2->setPicture("tata2");
        $d2->setArtist($a1);
        $manager->persist($d2);

        $manager->flush();
    }
}
