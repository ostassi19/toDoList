<?php

namespace App\Listener;

use App\Document\Card;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use FOS\ElasticaBundle\Event\PostTransformEvent;
use FOS\ElasticaBundle\Persister\ObjectPersisterInterface;
use FOS\ElasticaBundle\Provider\IndexableInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;

class CardIndexListener implements EventSubscriberInterface
{
    protected $propertyAccessor;
    private $indexable;
    private $config;
    private $objectPersister;

//    public function __construct(
//        ObjectPersisterInterface $postPersister,
//        IndexableInterface $indexable,
//        array $config
//    ) {
//        $this->objectPersister = $postPersister;
//        $this->indexable = $indexable;
//        $this->config = $config;
//        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
//    }
    public static function getSubscribedEvents()
    {
        return [

        ];

//        return [
//            RequestEvent::class => 'addCard'
//        ];
    }

//    public function addCard(RequestEvent $event){
//        $entity = $event->getRequest();
//        if ($entity instanceof Card) {
//            if ($this->objectPersister->handlesObject($entity)) {
//                if ($this->isObjectIndexable($entity)) {
//                    $this->scheduledForInsertion[] = $entity;
//                }
//            }
//        }
//    }
//
//    private function isObjectIndexable($object)
//    {
//        return $this->indexable->isObjectIndexable(
//            $this->config['index'],
//            $this->config['type'],
//            $object
//        );
//    }
}