<?php

namespace App\Controller;

use App\Service\ReCaptchaKeys;
use App\Entity\Messages;
use App\Entity\Contact;
use App\Type\MessagesType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ReCaptcha\ReCaptcha;

class ContactController extends Controller
{
    /**
     * @Route("/contact",name="app_contact")
     * @param EntityManagerInterface $entityManager
     * @param ReCaptchaKeys $ReCaptchaKeys
     * @param Request $request
     * @return Response
     */
    public function add(ReCaptchaKeys $ReCaptchaKeys, Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * Catch Contact data
         * Count: all
         * Oder: Asc
         */
        $ContactRepository = $entityManager->getRepository(Contact::class);
        $contact = $ContactRepository->findAll();

        /**
         * Kontakt formular
         * Privaty Accept: Yes
         * reCaptcha: Yes
         */
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
            'contact'=>$contact,
            'form'=> $form->createView()
        ]);
    }
}