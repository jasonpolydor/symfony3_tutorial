<?php

namespace PlatformBundle\Controller;

use PlatformBundle\Entity\Article;
use PlatformBundle\Entity\Category;
use PlatformBundle\Entity\Tag;
use PlatformBundle\Form\CategoryFilterQueryType;
use PlatformBundle\Form\ArticleFilterQueryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class QueryController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class);
        $article = $em->getRepository(Article::class);
        $categories = $category->findAll();

        $searchByCategory = $this->searchByCategory();
        $searchByArticle = $this->searchByArticle();

        foreach ($categories as $c) {
            $articles[$c->getName()] = $article->findArticleByCategory($c);
        }

        return $this->render('PlatformBundle:Query:list.html.twig', [
            'categories' => $categories,
            'articles' => $articles,
            'searchByCategory' => $searchByCategory->createView(),
            'searchByArticle' => $searchByArticle->createView(),
        ]);
    }

    private function searchByCategory()
    {
        return $this->createForm('PlatformBundle\Form\CategoryFilterQueryType');
    }

    private function searchByArticle(){
        return $this->createForm('PlatformBundle\Form\ArticleFilterQueryType');
    }
}
