<?php

namespace Tradee\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TradeeGeneratorBundle:Default:index.html.twig');
    }
}
