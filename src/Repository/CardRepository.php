<?php

namespace App\Repository;

use App\Document\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[]    findAll()
 * @method Card[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends ServiceEntityRepository
{
    private $manager;
    public function __construct(ManagerRegistry $registry,DocumentManager $manager)
    {
       // parent::__construct($registry, Card::class);
        $this->manager = $manager;

    }

    public function saveCard($title, $content)
    {
        $newCard = new Card();
        $newCard->setTitle($title);
        $newCard ->setContent($content);
        $this->manager->persist($newCard);
        $this->manager->flush();
    }

    public function updateCard(Card $card): Card
    {
        $this->manager->persist($card);
        $this->manager->flush();

        return $card;
    }
    public function removeCard(Card $card)
    {
        $this->manager->remove($card);
        $this->manager->flush();
    }
}
