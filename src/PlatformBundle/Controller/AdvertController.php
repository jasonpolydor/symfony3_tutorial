<?php

namespace PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdvertController extends Controller
{
    public function indexAction(Request $request){
        // On récupère le service
        $antispam = $this->container->get('platform.antispam');

        //$text = 'This is not a Spam';
        $text = 'test';

        if ($antispam->isSpam($text)) {
            //throw new \Exception('Votre message a été détecté comme spam !');
            $msg = "Votre message a été détecté comme spam !";
        }else{
            $msg = "Super! Votre message n'est pas un spam !";
        }

        return $this->render('PlatformBundle:Advert:index.html.twig',array('msg'=>$msg));
    }
}
