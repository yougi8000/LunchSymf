<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\PostLike;
use App\Entity\ArticleCategory;
use App\Entity\CategoryRestaurant;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();
        $user = [];

        for($cs = 0; $cs <= 3; $cs++) {
            $categoryRestaurant = new CategoryRestaurant();
            $categoryRestaurant->setTitle($faker->company())
                                ->setPicture($faker->imageUrl())
                                ->setDescription($faker->sentence($nbWords = 2, $variableNbWords = true));
            $manager->persist($categoryRestaurant);
            for($r = 0; $r <= 5; $r++) {
                $restaurant = new Restaurant();
                $restaurant->setName($faker->sentence())
                                    ->setPhoto($faker->imageUrl())
                                    ->setAdress($faker->streetAddress())
                                    ->setCity($faker->city())
                                    ->setCategory($faker->sentence($nbWords = 2, $variableNbWords = true))
                                    ->setDescription($faker->sentence($nbWords = 2, $variableNbWords = true))
                                    ->setCategoryRestaurant($categoryRestaurant)
                                    ->setDesign($faker->sentence($nbWords = 2, $variableNbWords = true))
                                    ->setKitchen($faker->sentence($nbWords = 2, $variableNbWords = true));
                $manager->persist($restaurant);
            }
        }


        for ($y = 1; $y <= 5; $y++) {
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
                ->setBirthday($faker->dateTimeBetween('-12 months'))
                ->setSince($faker->dateTimeBetween('-12 months'))
                ->setPhone('06 06 06 06 06');

            $users[] = $user;

            $manager->persist($user);

            $users[] = $user;



            for ($z = 1; $z <= 3; $z++) {
                $category = new ArticleCategory();
                $category->setTitle($faker->sentence())
                    ->setDescription($faker->paragraph());
            }
            $manager->persist($category);


            for ($i = 0; $i < 5; $i++) {
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
            for ($i = 1; $i <= 3; $i++) {
                $category = new ArticleCategory();
                $category->setTitle($faker->sentence())
                    ->setDescription($faker->paragraph());
            }
            $manager->persist($category);

            //Créer entre 15 et 20 articles
            for ($j = 1; $j <= mt_rand(15, 20); $j++) {
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
                for ($k = 1; $k <= mt_rand(5, 8); $k++) {
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
}
