<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('facebook', TextType::Class, [
                'label'=>'Facebook link',
                'help'=>'There you should enter a link for your Facebook profile.'
            ])
            ->add('twitter', TextType::Class, [
                'label'=>'Twitter link',
                'help'=>'There you should enter a link for your Twitter profile.'
            ])
            ->add('instagram', TextType::Class, [
                'label'=>'Instagram link',
                'help'=>'There you should enter a link for your Instagram profile.'
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