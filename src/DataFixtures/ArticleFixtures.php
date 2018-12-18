<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $article1 = new Article();
        $article2 = new Article();
        $article3 = new Article();

        $article1
            ->setTitle('Titre 1')
            ->setBody('Contenu 1');

        $article2
            ->setTitle('Titre 2')
            ->setBody('Contenu 2');

        $article3
            ->setTitle('Titre 3')
            ->setBody('Contenu 3')
            ->setPublished(true);

        $manager->persist($article1);
        $manager->persist($article2);
        $manager->persist($article3);

        $manager->flush();
    }
}
