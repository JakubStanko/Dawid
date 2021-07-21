<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Messages;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * class PrivateController
 * @Route("/config/private", name="app_private")
 * @IsGranted("ROLE_ADMIN")
 */
class PrivateController extends AbstractController
{
    /**
     * @Route("/list", name="app_private_list")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Messages::class);
        $messages = $repository->findBy(
            ['status'=>'0']
        );

        return $this->render('private/index.html.twig', [
            'messages' => $messages
        ]);
    }

    /**
     * This method setting status = 1 / list showing only rows with status 0
     * @Route("/hide/{id}",methods={"POST"})
     * @param Messages $messages
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function hide(Messages $messages, EntityManagerInterface $entityManager): Response
    {
        $messages->setStatus(1);
        $entityManager->flush();

        return $this->redirectToRoute('app_privateapp_private_list');
    }
}