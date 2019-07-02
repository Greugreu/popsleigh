<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 100; $i++) {
            $property = new Property();
            $property
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->words(5, true))
                ->setStart($faker->words(1, true))
                ->setDestination($faker->words(1, true))
                ->setSeats($faker->numberBetween(1,5))
                ->setPrice($faker->numberBetween(0,30))
                ->setTime($faker->numberBetween(6,21))
                ->setType($faker->numberBetween(0, count(Property::TYPE) - 1))
                ->setParticipation($faker->boolean(50))
                ->setFull(false);
            $manager->persist($property);
        }

        $manager->flush();
    }
}

