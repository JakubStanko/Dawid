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
 * class ConfigRecommendationController
 * @Route("/config/public")
 * @IsGranted("ROLE_ADMIN")
 */
class ConfigRecommendationController extends AbstractController
{
    /**
     * @Route("/list", name="app_config_recommendation_list")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Recommendation::class);
        $recommendation = $repository->findBy(
            ['status'=>'0']
        );

        return $this->render('config_recommendation/index.html.twig', [
            'messages' => $recommendation
        ]);
    }

    /**
     * This method setting status = 1 / list showing only rows with status 0
     * @Route("/hide/{id}",methods={"POST"}, name="app_config_recommendation_hide")
     * @param Recommendation $recommendation
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function hide(Recommendation $recommendation, EntityManagerInterface $entityManager): Response
    {
        $recommendation->setStatus(1);
        $entityManager->flush();

        return $this->redirectToRoute('app_config_recommendation_list');
    }
}