<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',null,[
                'required'   => true])
            ->add('confirm_email')
            ->add('firstname',null,[
                'required'   => true])
            ->add('lastname',null,[
                'required'   => true])
            ->add('username',null,[
                'required'   => true])
            ->add('password',PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('zipcode',null,[
                'required'   => true])
            ->add('city',null,[
                'required'   => true])
            ->add('country',null,[
                'required'   => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
