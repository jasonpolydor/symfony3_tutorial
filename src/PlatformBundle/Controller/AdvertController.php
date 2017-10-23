<?php

namespace PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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

    public function testAction($id, Request $request){
        $tag = $request->request->get('tag');

        return new Response("l'affichage de l'id ".$id." avec le tag: ".$tag);
    }

    public function test2Action($id){
        // On crée la réponse sans lui donner de contenu pour le moment

        $response = new Response();

        // On définit le contenu

        $response->setContent("Ceci est une page d'erreur 404");


        // On définit le code HTTP à « Not Found » (erreur 404)

        $response->setStatusCode(Response::HTTP_NOT_FOUND);


        // On retourne la réponse

        return $response;
    }

    public function test3Action(){

//       $url = $this->get('router')->generate('app_platform_index');
//
//       return $this->redirect($url);

        return $this->redirectToRoute('app_platform_index');
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
