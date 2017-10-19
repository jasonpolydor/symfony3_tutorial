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
        $category = $em->getRepository(Category::class);
        $article = $em->getRepository(Article::class);
        $categories = $category->findAll();

        $search = $this->searchByCategory($category);


        foreach ($categories as $c) {
            $articles[$c->getName()] = $article->findArticleByCategory($c);
        }

        return $this->render('PlatformBundle:Query:list.html.twig', [
            'categories' => $categories,
            'articles' => $articles,
            'search' => $search
        ]);
    }

    private function searchByCategory()
    {
        $category = new Category();

        $search = $category ->findBy([],['name'=>'ASC']);
        dump($search);

        $form = $this->createForm(CategoryType::class, $category);

        foreach ($search as $value) {
            dump($value);
            $id[] = $value->getId();
            $name[] = $value->getName();
        }

        dump($id);
        dump($name);

        $form->add('choice_list', ChoiceType::class, ['choices' => array($id, $name)]);
    }
}
