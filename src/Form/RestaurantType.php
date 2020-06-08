<?php

namespace App\Form;

use App\Entity\CategoryRestaurant;
use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('adress')
            ->add('city')
            ->add('photo')
            ->add('categoryRestaurant', EntityType::class, [
                'class' => CategoryRestaurant::class,
                'choice_label' => 'Title',
            ])
            ->add('description', TextareaType::class)
            ->add('design')
            ->add('kitchen')
            ->add('year')
            ->add('platJour')
            ->add('entree')
            ->add('plat')
            ->add('dessert')
            ->add('drinks')
            ->add('promotion')
            ->add('waste')
            ->add('recipe')
            ->add('openhours')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
