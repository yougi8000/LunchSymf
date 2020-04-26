<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistersuiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sex',null,[
                'required'   => true])
            ->add('phone',null,[
                'required'   => true])
            ->add('picture',null,[
                'required'   => true])
            ->add('birthday',null,[
                'required'   => true])
            ->add('love',null,[
                'required'   => true])
            ->add('country')
            ->add('email')
            ->add('confirm_email')
            ->add('password')
            ->add('confirm_password')
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
