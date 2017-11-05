<?php

namespace Tradee\GeneratorBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class ViewListener {
    public function preExecute(\Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event){
        //result returned by the controller
        $data = $event->getControllerResult();

        /* @var $request  \Symfony\Component\HttpFoundation\Request */
        $request =  $event->getRequest();
        $template = $request->get('_template');
        $route = $request->get('_route');

        if(substr($route,0,7) == 'mobile_'){
            $newTemplate = str_replace('html.twig','mobile.html.twig',$template);

            //Overwrite original template with the mobile one
            $response = $this->templating->renderResponse($newTemplate, $data);
            $event->setResponse($response);
        }
    }

    public function onKernelView(FilterResponseEvent $event)
    {
//        $val = $event->getResponse();

//        $dom = new \DOMDocument();
//        $dom->loadHTML($val->getContent());
//        $dom->
//        var_dump($dom->childNodes->item(0));
//        var_dump($val->getContent());
//        var_dump($val);
//        $response = new Response();

        // ... somehow customize the Response from the return value

//        $event->setResponse($response);
    }
}