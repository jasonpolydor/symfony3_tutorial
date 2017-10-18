<?php

namespace PlatformBundle\Controller;

use PlatformBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ArticleController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listArticles = $em->getRepository('PlatformBundle:Article')->findAll();

        return $this->render('PlatformBundle:Article:list.html.twig',array('listArticles'=>$listArticles));
    }
}
