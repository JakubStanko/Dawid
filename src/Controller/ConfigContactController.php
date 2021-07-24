<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Type\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectToRoute;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ConfigContactController extends Controller
{
    /**
     * @Route("/config/contact", name="app_config_contact_index")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Contact::class);
        $contact = $repository->findOneBy(['id'=>'1']);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->getCompanyName($request->get('companyName'));
            $contact->getPostCode($request->get('postCode'));
            $contact->getCity($request->get('city'));
            $contact->getStreet($request->get('street'));
            $contact->getPhone($request->get('phone'));
            $contact->getEmail($request->get('email'));
            $contact->getVat($request->get('vat'));
            $contact->getWebsite($request->get('website'));
            $contact->getBrn($request->get('brn'));
            $contact->getOwner($request->get('owner'));

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Contact data edited syccessfully!'
            );
        }

        $contact = $repository->findBy(['id'=>'1']);

        return $this->render('config_contact/index.html.twig',[
            'form'=> $form->createView(),
            'contactData'=> $contact
        ]);
    }
}
