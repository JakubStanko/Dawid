<?php

namespace App\Controller;

use App\Entity\HomeBlock;
use App\Type\BlockType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectToRoute;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * class ConfigHomeController
 * @Route("/config/home")
 * @IsGranted("ROLE_ADMIN")
 */
class ConfigHomeController extends Controller
{
    /**
     * @route("/{block_name}", requirements={"block_name"="^(first|second|third)$"}, name="app_config_home_index")
     * @param string $block_name
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(string $block_name, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(HomeBlock::class);
        $blockData = $repository->findBy(
            [
                'blockName'=>$block_name
            ]
        );

        $homeBlock = new HomeBlock();
        $form = $this->createForm(BlockType::class, $homeBlock);

        return $this->render('config_home/index.html.twig', [
            'block_name' => $block_name,
            'blockData' => $blockData,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/{block_name}/edit",  requirements={"block_name"="^(first|second|third)$"}, methods={"POST"}, name="app_config_home_edit")
     * @param string $block_name
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function edit(string $block_name, EntityManagerInterface $entityManager, Request $request): Response
    {
        $homeBlock = $entityManager->getRepository(HomeBlock::class)->findOneBy([
            'blockName' => $block_name
        ]);

        $form = $this->createForm(BlockType::class, $homeBlock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $homeBlock->getImageTitle($request->get('imageTitle'));
            $homeBlock->getTextTitle($request->get('textTitle'));
            $homeBlock->getTextValue($request->get('textValue'));
            $homeBlock->getVisibility(intval($request->get('visibility')));
            $entityManager->flush();

            $this->addFlash(
                'success',
                'The block data update was successful!'
            );

            return $this->redirectToRoute('app_config_home_index',array('block_name' => $block_name));
        }

        $this->addFlash(
            'error',
            'Block data update not successful! Please check block element requirements'
        );
        return $this->redirectToRoute('app_config_home_index',array('block_name' => $block_name));
    }
}
