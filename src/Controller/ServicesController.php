<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services")
     */
    public function main(): Response
    {
        return $this->render('services\services.html.twig',[
            'empties'=>'empty'
        ]);
    }
}