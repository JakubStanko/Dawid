<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::Class, [
                'label'=>'User login',
                'help'=>'Requirements: Login must be email and can be 180 characters long.',
                'required' => true
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password',
                                     'help'=>'The password shouldn\'t be easy to guess.',
                                     'attr'=>
                                        ['autocomplete'=>'off']
                                    ],
                'second_options' => ['label' => 'Repeat Password',
                                     'help'=>'The both password should be same.',
                                     'attr'=>
                                        ['autocomplete'=>'off']
                                    ],
            ])
            ->add('Update', SubmitType::Class,[
                'label'=>'Save',
                'attr' => [
                    'class'=>'main-button'
                ]
            ])
            ->getForm();
    }
}