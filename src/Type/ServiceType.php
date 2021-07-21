<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('serviceTitle', TextType::Class, [
                'label'=>'Service Title',
                'help'=>'Requirements: Service Title can be 50 characters long.'
            ])
            ->add('serviceValue', TextareaType::Class, [
                'label'=>'Service value',
                'help'=>'Requirements: Service value can be 100 characters long.'
            ])
            ->add('visibility', ChoiceType::Class,[
                'label'=>'Block visibility',
                'help'=>'Requirements: set block visibility.',
                'choices' => [
                    'Block visibility' => [
                        'Visible' => '0',
                        'Hidden' => '1',
                    ]
                ]
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