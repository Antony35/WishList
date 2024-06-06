<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $movie = Array();
        for ($i = 0; $i < 4; $i++) {
            $movie[$i] = new Wish();
            $movie[$i]->setTitle($faker->title);
            $movie[$i]->setAuthor($faker->name);
            $movie[$i]->setDescription($faker->text);
            $movie[$i]->setPublished($faker->boolean());
            $movie[$i]->setCreatedAt(new \DateTimeImmutable);

            $manager->persist($movie[$i]);
        }

        $manager->flush();
    }
}
