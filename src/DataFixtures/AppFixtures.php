<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->name);
            $category->setSlug($faker->slug);
            for ($i = 0; $i < 50; $i++) {
                $article = new Article();
                $article->setTitle($faker->title);
                $article->setCreatedAt($faker->dateTime);
                $article->setPublishedAt($faker->dateTime);
                $article->setEnable($faker->boolean);
                $article->setDescription($faker->text);
                $article->setCategory($category);
                $manager->persist($article);
            }
            $manager->persist($category);
        }


        $manager->flush();
    }
}
