<?php

namespace App\Controller;

use App\Service\ImageUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * class ImageController
 * @package
 */
class ImageController extends Controller
{
    /**
     * @route("/save_image_file",methods={"POST"})
     * @param Request $request
     */
    public function main(Request $request): Response
    {
        $image = new ImageUploader();
        $image->setName($request->get('name'));
        $image->setExtension($request->get('extension'));
        $image->setFolder($request->get('folder'));
        $image->setType($request->get('type'));
        $image->save();

        return new Response();
    }
}