<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/compress", name="compress")
     */
    public function compressAction(Request $request)
    {
        $prefix = 'lossish';
        $uploadDir = $this->getParameter('image_upload_dir');
        $src = $request->query->get('url');
        // $src = '/var/www/project/web/uploads/xclient-png.png';
        $filename = basename($src);
        $dest = "$uploadDir/$prefix-$filename";
        $filepath = $this->get('image_compressor')->compress($src, $dest);

        return $this->redirect(str_replace($uploadDir, '/uploads', $filepath));
    }
}
