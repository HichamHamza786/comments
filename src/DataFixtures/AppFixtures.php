<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $commentList = [];

        for ($i = 0; $i < 50; $i++) {
            $comment = new Comment();
            $comment->setTitle($faker->sentence(6));
            $comment->setContent($faker->paragraph(3));
            $comment->setAuthor($faker->name);
            $comment->setIpAddress($faker->ipv4);
            $comment->setPublishedAt(new \DateTimeImmutable($faker->date('Y-m-d H:i:s')));

            $commentList[] = $comment;

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
