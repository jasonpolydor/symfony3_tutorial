<?php

namespace PlatformBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use PlatformBundle\Entity\Article;
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

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            'postPersist'
        ];
    }
}