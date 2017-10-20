<?php

namespace PlatformBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use PlatformBundle\Entity\Article;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class ArticleListener
{
    private $logger;

    public function __contruct(LoggerInterface $logger){
        $this->logger = $logger;
    }

    public function postPersist(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if(!$entity instanceof Article){
            return;
        }

        $this->logger->error(sprintf('Article %s avec le ID %s a ete ajouter dans la bdd!',[$entity->getTitle(),$entity->getId()]));
    }
}