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
 * class ConfigMessagesController
 * @Route("/config/private")
 * @IsGranted("ROLE_ADMIN")
 */
class ConfigMessagesController extends AbstractController
{
    /**
     * @Route("/list", name="app_config_private_list")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Messages::class);
        $messages = $repository->findBy(
            ['status'=>'0']
        );

        return $this->render('config_messages/index.html.twig', [
            'messages' => $messages
        ]);
    }

    /**
     * This method setting status = 1 / list showing only rows with status 0
     * @Route("/hide/{id}",methods={"POST"},name="app_config_private_hide")
     * @param Messages $messages
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function hide(Messages $messages, EntityManagerInterface $entityManager): Response
    {
        $messages->setStatus(1);
        $entityManager->flush();

        return $this->redirectToRoute('app_config_private_list');
    }
}