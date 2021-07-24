<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * class PersonallDataController
 */
class PersonallDataController extends AbstractController
{
    /**
     * @Route("personal_data",name="app_presonal_data")
     * @return Response
     */
    public function main(): Response
    {
        return $this->render('personallData/de/personallData.html.twig');
    }
}