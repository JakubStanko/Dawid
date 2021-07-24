<?php

namespace App\Controller;

use App\Entity\HomeBlock;
use App\Entity\Recommendation;
use App\Entity\Contact;
use App\Type\RecommendationType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectToRoute;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * class HelloController
 */
class HomeController extends Controller
{
    /**
     * @Route("/home",name="app_home")
     * @Route("/");
     * @param EntityManagerInterface $entityManager
     * @return Response Response
     */
    public function list(EntityManagerInterface $entityManager): Response
    {

        /**
         * Catch Home blocks
         * Count: All
         * Oder: Asc
         */
        $HomeBlockRepository = $entityManager->getRepository(HomeBlock::class);
        $blocks = $HomeBlockRepository->findAll();

        /**
         * Catch Recommendation
         * Count: 5
         * Order: Desc
         */
        $RecommendationRepository = $entityManager->getRepository(Recommendation::class);
        $comments = $RecommendationRepository->findby(array('status'=>'0'),array('id' => 'DESC'),5,0);

        //Create new formular for Recomendation
        $recommendation = new Recommendation();
        $form = $this->createForm(RecommendationType::class, $recommendation);

        /**
         * Catch Contact data
         * Count: all
         * Oder: Asc
         */
        $ContactRepository = $entityManager->getRepository(Contact::class);
        $contact = $ContactRepository->findAll();

        return $this->render('home/index.html.twig',[
            'blocks'=>$blocks,
            'comments'=>$comments,
            'form'=> $form->createView(),
            'contact'=>$contact
        ]);
    }
}