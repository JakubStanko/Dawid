<?php

namespace App\Controller;

use App\Entity\Media;
use App\Type\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * class ConfigMediaController
 * @Route("/config")
 */
class ConfigMediaController extends Controller
{
    /**
     * @Route("/media", name="app_config_media")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Media::class);
        $media = $repository->findOneBy(['id'=>'1']);

        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media->getFacebook($request->get('Facebook'));
            $media->getTwitter($request->get('Twitter'));
            $media->getInstagram($request->get('Instagram'));

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Media data edited syccessfully!'
            );
        }

        $mediaData = $repository->findBy(['id'=>'1']);

        return $this->render('config_media/index.html.twig', [
            'mediaData' => $mediaData,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function catchAction(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Media::class);

        $mediaData = $repository->findBy(['id'=>'1']);

        return $this->render('config_media/footer.html.twig', [
            'mediaData' => $mediaData,
        ]);
    }
}
