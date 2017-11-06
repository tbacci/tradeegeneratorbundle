<?php

namespace Tradee\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\IdentityTranslator;
use Tradee\GeneratorBundle\StaticsManager\StaticsManager;

class InfosController extends Controller {


    /**
     * @return StaticsManager
     */
    private function getStaticsManager(){
        /** @var StaticsManager $staticsManager */
        $staticsManager = $this->get('tradee.statics_manager');

        return $staticsManager;
    }


    public function toolbarAction(){

        $response = [];

        $staticsManager = $this->getStaticsManager();

        if(!$staticsManager->isInitialized()){
            $response['error'] = 'Project not initialized';
            $response['code'] = '0';
        }

        return new JsonResponse($response);
    }

    public function initializationAction(){

        $staticsManager = $this->getStaticsManager();

        var_dump($staticsManager->initialize());

        return new Response('ll');
    }
}
