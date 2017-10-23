<?php

namespace PlatformBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use PlatformBundle\Entity\Article;
use PlatformBundle\Entity\Category;
use Psr\Log\LoggerInterface;

class ArticleListener implements EventSubscriber
{
    protected $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }

    public function postPersist(LifecycleEventArgs $args){
        $entity = $args->getObject();
        if(!$entity instanceof Article){
            return;
        }

        $this->logger->info(sprintf('Article %s avec le ID %s a ete ajouter dans la bdd!',$entity->getTitle(),$entity->getId()));
    }

    public function prePersist(LifecycleEventArgs $args){

        $entity = $args->getObject();
        $em = $args->getObjectManager();

        if(!$entity instanceof Article){
            return;
        }

        $categoryObj = $entity->getCategory();

        if($categoryObj){
            $categoryName = $categoryObj->getName();
            dump($categoryName);
            dump('ok');
            exit;
        }else{
            dump('ko');
            exit;
        }

//        $category = $em->getRepository(Category::class);
//
//        $exist = $category->findOneBy(array('name' => $categoryName), array('name' => 'ASC'));
//
//        if($exist){
//            dump('already exist');
//            exit;
//        }else{
//            dump('you can insert');
//            exit;
//        }
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            'postPersist','prePersist'
        ];
    }
}