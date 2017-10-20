<?php

namespace PlatformBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use PlatformBundle\Entity\Category;
use Psr\Log\LoggerInterface;

class CategoryListener implements EventSubscriber
{
    protected $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }

    public function postPersist(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if(!$entity instanceof Category){
            return;
        }

        $this->logger->info(sprintf('Category %s avec le ID %s a ete ajouter dans la bdd!',$entity->getName(),$entity->getId()));
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