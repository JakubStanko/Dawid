<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $contact = new Contact();
        $contact->setCompanyName('Your Company name.');
        $contact->setPostCode('Your PostCode.');
        $contact->setCity('Your City.');
        $contact->setStreet('Your Street.');
        $contact->setPhone('Your Phone.');
        $contact->setEmail('Your Email.');
        $contact->setVat('Your Vat.');
        $contact->setWebsite('Your Website.');
        $contact->setBrn('Your Brn.');
        $contact->setOwner('You.');

        $manager->persist($contact);
        $manager->flush();
    }
}

