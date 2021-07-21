<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MessagesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, ['label'=>'Name'])
        ->add('email', TextType::class, ['label'=>'Email'])
        ->add('message', TextareaType::class, ['label'=>'die Nachricht'])
        ->add('PersonalData', CheckboxType::class, [
            'label'=>'Ich habe die Datenschutzbestimmungen zur Kenntnis genommen.',
            'help'=> '<a href="/personal_data" style="color: #689f38;">Datenschutzbestimmungen</a>',
            'help_html' => true
        ])
        ->add('Update', SubmitType::class,['label'=>'Senden'])
        ->getForm();
    }
}