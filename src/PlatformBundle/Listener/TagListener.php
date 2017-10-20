<?php

namespace PlatformBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use PlatformBundle\Entity\Tag;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TagListener extends Controller implements EventSubscriber
{
    protected $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }

    public function postPersist(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if(!$entity instanceof Tag){
            return;
        }

        $this->logger->info(sprintf('Tag %s avec le ID %s a ete ajouter dans la bdd!',$entity->getName(),$entity->getId()));
    }

    public function prePersist(LifecycleEventArgs $args){

        $entity = $args->getObject();
        $em = $args->getObjectManager();

        if(!$entity instanceof Tag){
            return;
        }

        $tagName = $entity->getName();


        $tags = $em->getRepository(Tag::class);


        $exist = $tags->findOneBy(array('name' => $tagName), array('name' => 'ASC'));

        if($exist){
            dump('already exist');
            //exit;
        }else{
            dump('you can insert');
            //exit;
        }
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