<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;




class AppFixtures extends Fixture
{   

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
   

        $faker = Faker\Factory::create();
        $users=[];

        for($i=0; $i < 50; $i++){
            $user = new user();
            $user->setUsername($faker->name);
            $user->setFirstname($faker->FirstName());
            $user->setLastname($faker->lastname());
            $user->setPassword($faker->password());
            $user->setEmail($faker->email);
            $user->setCreatedAT(new \DateTimeImmutable());
            $manager->persist($user);
            $users[]=$user;

        }

        $categories=[];
        for($i=0; $i < 15; $i++){
            $category = new category();
            $category->setTitle($faker->text(50));
            $category->setDescription($faker->text(250));
            $category->setImage($faker->ImageUrl());
            $manager->persist($category);
            $categories[]=$category;

        }

        $articles=[];
        for($i=0; $i < 100; $i++){
            $article = new Article();
            $article->setTitle($faker->text(50));
            $article->setContent($faker->text(6000));
            $article->setImage($faker->ImageUrl());
            $article->setCreatedAt(new \DateTimeImmutable());
            $article->addCategory($categories[$faker->numberBetween(0,14)]);
            $article->setAuthor($users[$faker->numberBetween(0,49)]);
            $manager->persist($article);

        }
        $manager->flush();
    }
}
