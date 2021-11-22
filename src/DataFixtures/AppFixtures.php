<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create();
        $user = [];

        for ($i = 0; $i < 30; ++$i) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password());
            $user->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($user);
            $users[] = $user;

            $manager->flush();
        }
        $categories = [];
        for ($i = 0; $i < 10; ++$i) {
            $category = new Category();
            $category->setTitle($faker->text(50));
            $category->setDescription($faker->text(250));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;
        }
        $articles = [];
        for ($i = 0; $i < 50; ++$i) {
            $article = new Article();
            $article->setTitle($faker->text(50));
            $article->setContent($faker->text(6000));
            $article->setImage($faker->imageUrl());
            $article->setCreatedAt(new \DateTimeImmutable());
            $article->addCategory($categories[$faker->numberBetween(0, 9)]);
            $article->setAuthor($users[$faker->numberBetween(0, 29)]);
            $manager->persist($article);
            $articles[] = $article;
            $manager->flush();
        }
    }
}
