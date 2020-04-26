<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
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
            ->add('category')
            ->add('description')
            ->add('design')
            ->add('kitchen')
            ->add('year')
            ->add('platJour')
            ->add('entree')
            ->add('plat')
            ->add('dessert')
            ->add('likes')
            ->add('drinks')
            ->add('promotion')
            ->add('waste')
            ->add('recipe')
            ->add('openhours')
            ->add('profile')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
