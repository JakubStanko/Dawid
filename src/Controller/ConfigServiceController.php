<?php

namespace App\Controller;

use App\Entity\Service;
use App\Type\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * class ConfigServiceController
 * @Route("/config/service")
 * @IsGranted("ROLE_ADMIN")
 */
class ConfigServiceController extends Controller
{
    /**
     * @Route("/list", name="app_config_service_list")
     * @param EntityManagerInterface $entityManager
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $listRepository = $entityManager->getRepository(Service::class)->findAll();

        return $this->render('config_service/list.html.twig', [
            'serviceData' => $listRepository,
        ]);
    }

    /**
     * @Route("/create", name="app_config_service_create")
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

       return $this->render('config_service/create.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}",name="app_config_service_edit")
     * @param Service $service
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function edit(Service $service, int $id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $serviceData = $entityManager->getRepository(Service::class)->findBy(['id'=>$id]);

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->getServiceTitle($request->get('serviceTitle'));
            $service->getServiceValue($request->get('serviceValue'));
            $service->getVisibility(intval($request->get('visibility')));
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Service block edited syccessfully!'
            );

        }

        return $this->render('config_service/edit.html.twig',[
            'form'=> $form->createView(),
            'serviceValue'=> $serviceData
        ]);
    }

    /**
     * @route(methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function hide(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->get('id');
        $service = $entityManager->getRepository(Service::class)->findOneBy(['id'=>$id]);
        $service->setVisibility(1);

        $entityManager->flush();

        return new Response();
    }

    /**
     * @route(methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function unhide(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->get('id');
        $service = $entityManager->getRepository(Service::class)->findOneBy(['id'=>$id]);
        $service->setVisibility(0);

        $entityManager->flush();

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     * @param EntityManagerInterface $entityManager
     */
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->get('id');
        $service = $entityManager->getRepository(Service::class)->findOneBy(['id'=>$id]);

        $entityManager->remove($service);
        $entityManager->flush();

        return new Response();
    }
}
