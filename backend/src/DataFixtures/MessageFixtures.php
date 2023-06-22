<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MessageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $random = random_int(1000, 2500);
        $faker = Factory::create('pl_PL');
        for ($i = 0; $i < 100; $i++) {

            $message = new Message($faker->realText($random));
            $manager->persist($message);
            sleep(1);
            $manager->flush();
        }
    }
}
