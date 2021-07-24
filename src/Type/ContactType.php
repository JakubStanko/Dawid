<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companyName', TextType::Class, [
                'label'=>'Company name',
                'help'=>'Requirements: Company name can be 100 characters long.'
            ])
            ->add('postCode', TextType::Class, [
                'label'=>'Postal code',
                'help'=>'Requirements: Postal code can be 100 characters long.'
            ])
            ->add('city', TextType::Class, [
                'label'=>'City',
                'help'=>'Requirements: City can be 100 characters long.'
            ])
            ->add('street', TextType::Class, [
                'label'=>'Street',
                'help'=>'Requirements: Street can be 100 characters long.'
            ])
            ->add('phone', TextType::Class, [
                'label'=>'Phone',
                'help'=>'Requirements: Phone can be 100 characters long.'
            ])
            ->add('email', TextType::Class, [
                'label'=>'Email',
                'help'=>'Requirements: Email can be 100 characters long.'
            ])
            ->add('vat', TextType::Class, [
                'label'=>'Vat number',
                'help'=>'Requirements: Vat number can be 100 characters long.'
            ])
            ->add('website', TextType::Class, [
                'label'=>'Website',
                'help'=>'Requirements: Website can be 100 characters long.'
            ])
            ->add('brn', TextType::Class, [
                'label'=>'Business registration number',
                'help'=>'Requirements: Business registration number number can be 100 characters long.'
            ])
            ->add('owner', TextType::Class, [
                'label'=>'Owner Name',
                'help'=>'Requirements: Owner Name can be 100 characters long.'
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