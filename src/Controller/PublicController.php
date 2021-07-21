<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recommendation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * class PublicController
 * @Route("/config/public", name="app_public")
 * @IsGranted("ROLE_ADMIN")
 */
class PublicController extends AbstractController
{
    /**
     * @Route("/list", name="app_public_list")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Recommendation::class);
        $recommendation = $repository->findBy(
            ['status'=>'0']
        );

        return $this->render('public/index.html.twig', [
            'messages' => $recommendation
        ]);
    }

    /**
     * This method setting status = 1 / list showing only rows with status 0
     * @Route("/hide/{id}",methods={"POST"})
     * @param Recommendation $recommendation
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function hide(Recommendation $recommendation, EntityManagerInterface $entityManager): Response
    {
        $recommendation->setStatus(1);
        $entityManager->flush();

        return $this->redirectToRoute('app_publicapp_public_list');
    }
}