<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController
{
    /**
     * @Route("/main")
     */
    public function main(): Response
    {
        return $this->render('hello/hello.html.twig',[
            'empty_key'=>'empty'
        ]);
    }
}