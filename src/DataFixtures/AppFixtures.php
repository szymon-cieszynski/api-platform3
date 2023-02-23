<?php

namespace App\DataFixtures;

use App\Factory\DragonTreasureFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(10);
        DragonTreasureFactory::createMany(40, function () {
            return [
                'owner' => UserFactory::random(),
                /*second argument, which is a way to override the defaults. By passing a callback, each time a DragonTreasure is created - so 40 times - it will call this method
                and we can return unique data to use for overriding the defaults for that treasure. Return owner set to User::factory()->random().
                That'll find a random User object and set it as the owner. So we'll have 40 DragonTreasures each randomly hoarded by one of these 10 Users.*/
            ];
        });
    }
}
