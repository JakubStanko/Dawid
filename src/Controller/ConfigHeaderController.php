<?php

namespace App\Controller;

use App\Entity\Header;
use App\Type\HeaderType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * class ConfigHeaderController
 * @Route("/config")
 */
class ConfigHeaderController extends Controller
{
    /**
     * @Route("/header", name="app_config_header")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Header::class);
        $header = $repository->findOneBy(['id'=>'1']);

        $form = $this->createForm(HeaderType::class, $header);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $header->getTitle($request->get('title'));
            $header->getDescription($request->get('description'));

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Header data edited syccessfully!'
            );
        }

        $headerData = $repository->findBy(['id'=>'1']);

        return $this->render('config_header/index.html.twig', [
            'headerData' => $headerData,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function catchAction(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Header::class);

        $headerData = $repository->findBy(['id'=>'1']);

        return $this->render('config_header/header.html.twig', [
            'headerData' => $headerData,
        ]);
    }
}
