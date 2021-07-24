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
use App\Service\ReCaptchaKeys;

/**
 * Class RecommendationController
 * @package App\Controller
 */
class RecommendationController extends Controller
{
    /**
     * @Route("/home/new_recommendation",methods={"POST"})
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function create(ReCaptchaKeys $ReCaptchaKeys, Request $request,EntityManagerInterface $entityManager): Response
    {
        //Create new formular for Recomendation $request
        $recommendation = new Recommendation();
        $form = $this->createForm(RecommendationType::class, $recommendation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                //Check ReChaptcha v2
                $recaptcha = new ReCaptcha($ReCaptchaKeys->getSecret());
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

        return $this->redirectToRoute('/');
    }
}