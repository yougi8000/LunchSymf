<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\PostLike;
use App\Entity\ArticleCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ArticleFixtures extends Fixture
{
    /**
     * Encodeur de mot de passe
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager){
   
        $faker = Factory::create();
        $user = [];

        $user = new User();
        $user->setEmail('user@symfony.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setUsername($faker->name)
            ->setFirstname($faker->name)
            ->setLastname($faker->name)
            ->setZipcode('33000')
            ->setCity('Bordeaux')
            ->setCountry('France')
            ->setSex('homme')
            ->setPicture($faker->imageUrl())
            ->setPhone('06 06 06 06 06');

            $users[] = $user;

        $manager->persist($user);

        $users[] = $user;

       

        for($z = 1; $z <= 3; $z++) {
            $category = new ArticleCategory();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());                
        }
        $manager->persist($category);


        for ($i = 0; $i < 20; $i++) {
            $article = new Article();


            $content = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut urna magna, efficitur vitae malesuada et, malesuada at ex. Phasellus placerat fringilla lectus, at eleifend lacus pulvinar congue. In porta mi sit amet ligula bibendum, vel consectetur metus tempus. Etiam fringilla diam a condimentum sodales. Vestibulum eleifend libero vitae metus fermentum, vel maximus sapien mollis. Maecenas sagittis nisl velit, eu posuere mauris vestibulum ornare. Vivamus luctus libero lacus, ac dapibus nunc semper vitae. <p>';

            $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setResume($faker->sentence())
                    ->setIsLiked(false)
                    ->setImage($faker->imageUrl())
                    ->setCategory($category)
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'));

                    $manager->persist($article);

          
        }

        for ($j = 0; $j < mt_rand(0, 10); $j++) {
            $like = new PostLike();
            $like->setPost($article)
                ->setUser($faker->randomElement($users));

            $manager->persist($like);
        }


        $manager->flush();
    

        //Créé 3 catégories fakées
        for($i = 1; $i <= 3; $i++) {
            $category = new ArticleCategory();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());                
        }
        $manager->persist($category);

        //Créer entre 15 et 20 articles
        for($j = 1; $j <= mt_rand(15, 20); $j++){
            $article = new Article();
            $number = $i;

            $content = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut urna magna, efficitur vitae malesuada et, malesuada at ex. Phasellus placerat fringilla lectus, at eleifend lacus pulvinar congue. In porta mi sit amet ligula bibendum, vel consectetur metus tempus. Etiam fringilla diam a condimentum sodales. Vestibulum eleifend libero vitae metus fermentum, vel maximus sapien mollis. Maecenas sagittis nisl velit, eu posuere mauris vestibulum ornare. Vivamus luctus libero lacus, ac dapibus nunc semper vitae. <p>';

            $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setResume($faker->sentence())
                    ->setIsLiked(false)
                    ->setImage($faker->imageUrl())
                    ->setCategory($category)
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'));

                    $manager->persist($article);

        //on donne des commentaires à l'article
        for($k = 1; $k <= mt_rand(5, 8); $k++) {
            $comment = new Comment();
            $content = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut urna magna, efficitur vitae malesuada et, malesuada at ex. Phasellus placerat fringilla lectus, at eleifend lacus pulvinar congue. In porta mi sit amet ligula bibendum, vel consectetur metus tempus. Etiam fringilla diam a condimentum sodales. Vestibulum eleifend libero vitae metus fermentum, vel maximus sapien mollis. Maecenas sagittis nisl velit, eu posuere mauris vestibulum ornare. Vivamus luctus libero lacus, ac dapibus nunc semper vitae. <p>';

            $now = new \DateTime();
            $interval = $now->diff($article->getCreatedAt());
            $days = $interval->days;
            $minimum = '-' . $days . ' days';

            $comment->setAuthor($faker->name)
                    ->setContent($content)
                    ->setCreatedAt($faker->dateTimeBetween($minimum))
                    ->setArticle($article);

            $manager->persist($comment);
        }
    }
        $manager->flush();
    }

}