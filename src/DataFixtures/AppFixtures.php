<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Img;
use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Category;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //initialize Faker
        $faker = Faker\Factory::create('fr_FR');
        //initialize Slug
        $slugify = new Slugify();

        // Boucle/ I need 5 posts
        for($i=0; $i<=5; $i++)
        {
            $title= $faker->sentence();
            $slug = $slugify->slugify($title);
            $content= $faker->sentence();
            //the objects
            $img= new Img();
                $url= $faker->imageUrl($width = 640, $height = 480);
                $alt= $faker->sentence();
                    $img->setUrl($url);
                    $img->setAlt($alt);
                        //$post->setImg($img);

            $category= new Category();
                $catTitle= $faker->sentence();
                    $category->setTitle($catTitle);
                        //$post->setCategory($category);
            
            $comment= new Comment();
                $author= $faker->name(); 
                $commentContent= $faker->sentence(5);
                    $comment->setAuthor($author);
                    $comment->setContent($author);
                    $comment->setCreatedAt(new \DateTime('now'));
                        //$post->setComment($comment);
        
            //fixtures
            $post= new Post();
                $post->setTitle($title);
                $post->setSlug($slug);
                $post->setContent($content);
                $post->setImg($img);
                $post->setCategory($category);
                $post->addComment($comment);
                $post->setCreatedAt(new \DateTime('now'));
                
            $manager->persist($post);
        }

        $manager->flush();
    }
}
