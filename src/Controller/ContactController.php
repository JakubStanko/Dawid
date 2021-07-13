<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact")
     */
    public function main(): Response
    {
        return $this->render('contact/contact.html.twig',[
            'empty_key'=>'empty'
        ]);
    }
}