<?php

namespace App\Controller;

use App\Entity\Recommendation;
use App\Type\RecommendationType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectToRoute;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ReCaptcha\ReCaptcha;

/**
 * Class RecommendationController
 * @package App\Controller
 */
class RecommendationController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response Response
     * @Route("/home")
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        //Catch data from DataBase
        $repository = $entityManager->getRepository(Recommendation::class);
        $comments = $repository->findby(
            array(),
            array('id' => 'DESC'),
            5,
            0
        );

        //Create new formular for Recomendation
        $recommendation = new Recommendation();
        $form = $this->createForm(RecommendationType::class, $recommendation);

        return $this->render('hello/hello.html.twig',[
            'comments'=>$comments,
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route("/home/new_recommendation",methods={"POST"})
     */
    public function create(Request $request,EntityManagerInterface $entityManager): Response
    {
        //Create new formular for Recomendation $request
        $recommendation = new Recommendation();
        $form = $this->createForm(RecommendationType::class, $recommendation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                //Check ReChaptcha v2
                $recaptcha = new ReCaptcha('6Ldb1JUbAAAAAKSSyVaHQVtGLGWZ2L9xtlGhFaay');
                $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

                if ( $resp->isSuccess() ){
                    $entityManager->persist($recommendation);
                    $entityManager->flush();

                    //Clear recommendation formular
                    $recommendation = new Recommendation();
                    $form = $this->createForm(RecommendationType::class, $recommendation);

                    $this->addFlash(
                        'success',
                        'die Aussage wurde erfolgreich hinzugefügt, Danke!'
                    );

                } else {
                    $this->addFlash(
                        'reCaptcha',
                        'Das reCAPTCHA wurde nicht richtig eingegeben. Gehen Sie zurück und versuchen Sie es erneut.'
                    );
                }
            } else {
                $this->addFlash(
                    'error',
                    'Name sollte ab 2 bis 15 Zeichen haben. die Aussage sollte ab 3 bis 50 Zeichen haben.'
                );
            }
        }

        return $this->redirectToRoute('app_recommendation_list');
    }
}