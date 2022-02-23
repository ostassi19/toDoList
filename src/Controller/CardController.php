<?php

namespace App\Controller;

use App\Document\Card;
use App\Repository\CardRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\ElasticaBundle\Finder\TransformedFinder;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Rest\Route("/cards")
*/
class CardController extends AbstractFOSRestController
{

    private $cardRepository;
    private $documentManager;
    private $finder;


    public function __construct(CardRepository $cardRepository, DocumentManager $documentManager)
    {
        $this->cardRepository = $cardRepository;
        $this->documentManager = $documentManager;
    }

    /**
     * @Rest\Get("/")
     * @Rest\View(
     *     serializerGroups={"cardsWithoutId"}
     * )
     */
    public function listeCard(){
        return $this->documentManager->getRepository(Card::class)->findAll();
    }

    /**
     * @Rest\Post(
     * name = "project_new"
     * )
     * @Rest\View
     */
    public function addCard(Request $request, ValidatorInterface $validator){

        $data = $request->request->all();
        $card = new Card();
        $card->setTitle($data['title']);
        $card->setContent($data['content']);
        $errors = $validator->validate($card);

        //dump($errors); die();
        if (count($errors)>0){
           // $errorsString = (string)$errors;
            return $errors;
        }
        else{
            $this->documentManager->persist($card);
            $this->documentManager->flush();
            return ['status' => 'card created!'];
        }

    }

    /**
     * @Rest\Put(
     * path = "/{id}",
     * name="update_card"
     * )
     * @Rest\View
     */
    public function update($id, Request $request,DocumentManager $documentManager)
    {

        $card = $documentManager->getRepository(Card::class)->findOneBy(['id' => $id]);
        $data = $request->request->all();
         $card->setTitle($data['title']);
         $card->setContent($data['content']);
         $this->cardRepository->updateCard($card);
        return ['status' => 'card updated!'];
    }

    /**
     * @Rest\Delete(
     * path = "/{id}",
     * name="delete_card"
     * )
     * @Rest\View
     */
    public function delete($id,DocumentManager $documentManager)
    {
        $card = $documentManager->getRepository(Card::class)->findOneBy(['id' => $id]);

        $this->cardRepository->removeCard($card);

        return ['status' => 'Card deleted'];
    }

    /**
     * @Rest\Get(
     * path= "/search",
     * name = "search_card"
     * )
     * @Rest\View
     */
    public function cardAction(TransformedFinder $cardFinder)
    {
        $this->finder = $cardFinder;
        return  ($this->finder->find(''));
    }

}