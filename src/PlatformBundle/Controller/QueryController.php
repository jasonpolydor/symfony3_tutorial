<?php

namespace PlatformBundle\Controller;

use PlatformBundle\Entity\Article;
use PlatformBundle\Entity\Category;
use PlatformBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class QueryController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        foreach ($categories as $category) {
            $articles[$category->getName()] = $em->getRepository(Article::class)->findArticleByCategory($category);
        }

        return $this->render('PlatformBundle:Query:list.html.twig',[
            'categories' => $categories,
            'articles' => $articles
        ]);
    }
}
