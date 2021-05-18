<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        $blogPost = new BlogPost();
        $blogPost->setTitle('A first post!');
        $blogPost->setPublished(new \DateTime('now'));
        $blogPost->setAuthor('Peter');
        $blogPost->setContent('First');
        $blogPost->setSlug('a-first-book');

        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A second post!');
        $blogPost->setPublished(new \DateTime('now'));
        $blogPost->setAuthor('Parker');
        $blogPost->setContent('Second');
        $blogPost->setSlug('a-second-book');

        $manager->persist($blogPost);

        $manager->flush();
    }
}
