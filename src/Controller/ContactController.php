<?php

namespace App\Controller;

use App\Service\ReCaptchaKeys;
use App\Entity\Messages;
use App\Type\MessagesType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectToRoute;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ReCaptcha\ReCaptcha;

class ContactController extends Controller
{
    /**
     * @Route("/contact")
     * @param EntityManagerInterface $entityManager
     * @param ReCaptchaKeys $ReCaptchaKeys
     * @param Request $request
     * @return Response
     */
    public function add(ReCaptchaKeys $ReCaptchaKeys, Request $request, EntityManagerInterface $entityManager): Response
    {
        //Create new formular for Messages $request
        $Messages = new Messages();
        $form = $this->createForm(MessagesType::class, $Messages);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            //Check ReChaptcha v2


            $recaptcha = new ReCaptcha($ReCaptchaKeys->getSecret());
            $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

            if ( $resp->isSuccess() ){
                $entityManager->persist($Messages);
                $entityManager->flush();

                //Clear Messages formular
                $Messages = new Messages();
                $form = $this->createForm(MessagesType::class, $Messages);

                $this->addFlash(
                    'success',
                    'Ihre Nachricht wurde gesendet.'
                );
            } else {
                $this->addFlash(
                    'reCaptcha',
                    'Das reCAPTCHA wurde nicht richtig eingegeben. Gehen Sie zurück und versuchen Sie es erneut.'
                );
            }
        }

        return $this->render('contact/contact.html.twig',[
            'empty_key'=>'empty',
            'form'=> $form->createView()
        ]);
    }
}