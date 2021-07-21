<?php

namespace App\Controller;

use App\Entity\Service;
use App\Type\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ServiceBlockController extends Controller
{
    /**
     * @Route("config/service/list", name="service_list")
     * @param EntityManagerInterface $entityManager
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $listRepository = $entityManager->getRepository(Service::class)->findAllTest();

        return $this->render('service_block/index.html.twig', [
            'serviceData' => $listRepository,
        ]);
    }

    /**
     * @Route("config/service/create", name="service_create")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($service);
            $entityManager->flush();

            //Clear recommendation formular
            $service = new Service();
            $form = $this->createForm(ServiceType::class, $service);

            $this->addFlash(
                'success',
                'Service block created syccessfully! '
            );

        }

       return $this->render('service_block/index.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
