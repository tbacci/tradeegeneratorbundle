<?php

namespace Tradee\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tradee\GeneratorBundle\StaticsManager\StaticsManager;

class InfosController extends Controller {


    public function toolbarAction(){
        $this->get('tradee.statics_manager');

        $response = [];

        /** @var StaticsManager $staticsManager */
        $staticsManager = $this->get('tradee.statics_manager');

        if(!$staticsManager->isInitialized()){
            $response['error'] = 'Project not initialized';
            $response['code'] = '0';
        }

        return new JsonResponse($response);
    }
}
