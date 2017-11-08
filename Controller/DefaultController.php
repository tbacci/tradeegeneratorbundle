<?php

namespace Tradee\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $rootDir = realpath($this->get('kernel')->getRootDir() . '/../');
        return $this->render('TradeeGeneratorBundle:Default:index.html.twig');
    }
}
