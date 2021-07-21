<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageTitle', TextType::Class, [
                'label'=>'Title of Picture',
                'help'=>'Requirements: Title of Picture can be 100 characters long.'
            ])
            ->add('textTitle', TextType::Class, [
                'label'=>'Text Title',
                'help'=>'Requirements: Text Title can be 100 characters long.'
            ])
            ->add('textValue', TextareaType::Class, [
                'label'=>'Text value',
                'help'=>'Requirements: Text value can be 4500 characters long.'
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