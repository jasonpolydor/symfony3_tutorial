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
        $listCategories = $em->getRepository(Category::class)->findAll();

        foreach ($listCategories as $category) {
            $articlesCategory[] = $em->getRepository(Article::class)->findArticleByCategory($category);
            dump($articlesCategory);
        }

        return $this->render('PlatformBundle:Query:list.html.twig',[
            'articlesCategory' => $articlesCategory,
        ]);
    }
}
