<?php

namespace App\Controller;

use App\Entity\User;
use App\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ConfigUserController extends AbstractController
{
    /**
     * @Route("/config/user", name="app_config_user_edit")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager): Response
    {
        $userId = 1;

        $repository = $entityManager->getRepository(User::class);
        $userUpdate = $repository->findOneBy(['id'=>$userId]);
        $form = $this->createForm(UserType::class, $userUpdate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userEmail = $request->get('email');
            $userPassword = $request->get('user[password][first]');

            // encode the plain password
            $userUpdate->getEmail($userEmail);
            $userUpdate->setPassword(
                $passwordEncoder->encodePassword(
                    $userUpdate,
                    $userPassword
                )
            );
            //$userUpdate->getPassword($userPassword);

            $entityManager->flush();

            $this->addFlash(
                "success",
                "User data edited syccessfully!"
            );

        }

        $userData = $repository->findBy(['id'=>$userId]);

        return $this->render('config_user/index.html.twig', [
            'form' => $form->createView(),
            'userData' => $userData
        ]);
    }
}
