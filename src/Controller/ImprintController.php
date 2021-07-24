<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImprintController extends AbstractController
{
    /**
     * @Route("/imprint",name="app_imprint")
     */
    public function main(Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * Catch Contact data
         * Count: all
         * Oder: Asc
         */
        $ContactRepository = $entityManager->getRepository(Contact::class);
        $contact = $ContactRepository->findAll();

        return $this->render('imprint/imprint.html.twig',[
            'contact'=>$contact
        ]);
    }
}