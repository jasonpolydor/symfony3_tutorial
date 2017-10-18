<?php

namespace PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdvertController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request){
        // On récupère le service
        $antispam = $this->container->get('platform.antispam');

        $text = 'This is not a Spam';
        //$text = 'test';

        if ($antispam->isSpam($text)) {
            //throw new \Exception('Votre message a été détecté comme spam !');
            $msg = "Votre message a été détecté comme spam !";
        }else{
            $msg = "Super! Votre message n'est pas un spam !";
        }

        return $this->render('PlatformBundle:Advert:index.html.twig',array('msg'=>$msg));
    }


    public function mailAction(){
        $m = $this->container->get('platform.antispam');

        $mailer = $m->getMailer();

        var_dump($mailer);

//        $message = ($mailer('Hello Email'))
//            ->setFrom('jasonpolydor@gmail.com')
//            ->setTo('jasonpolydor@gmail.com')
//            ->setBody( "test", 'text/html');
//
//        $mailer->send($message);
    }
}
