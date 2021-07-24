<?php

namespace App\Controller;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectToRoute;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services",name="app_services")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     */
    public function main(EntityManagerInterface $entityManager, Request $request): Response
    {

        /**
         * Catch all services
         * Count: all
         * Order: Asc
         */
        $serviceRepository = $entityManager->getRepository(Service::class);
        $serviceData = $serviceRepository->findAll();

        return $this->render('services\services.html.twig',[
            'services'=>$serviceData
        ]);
    }
}