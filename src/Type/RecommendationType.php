<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecommendationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::Class, ['label'=>'Name'])
            ->add('Recommendation', TextareaType::Class, ['label'=>'die Aussage'])
            ->add('Update', SubmitType::Class,['label'=>'Feedback abschicken'])
            ->getForm();
    }
}