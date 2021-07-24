<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HeaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::Class, [
                'label'=>'Title',
                'help'=>'There you can enter e.g. Company Name. May contain 25 characters.'
            ])
            ->add('description', TextType::Class, [
                'label'=>'Description',
                'help'=>'There you can enter e.g. Short company info. May contain 40 characters.'
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