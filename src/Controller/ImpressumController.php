<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ImpressumController extends AbstractController
{
    /**
     * @Route("/impressum")
     */
    public function main(): Response
    {
        return $this->render('impressum/impressum.html.twig',[
            'empty_key'=>'empty'
        ]);
    }
}