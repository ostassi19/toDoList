<?php

namespace App\Controller;

use App\Document\User;
use App\Repository\UserRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;


class AuthentificationController extends AbstractFOSRestController
{

    private $userRepository;

    private $documentManager;

    public function __construct(UserRepository $userRepository, DocumentManager $documentManager)
    {
        $this->userRepository = $userRepository;
        $this->documentManager = $documentManager;
    }

    /**
     * @Rest\Post(
     * path = "/registration",
     * name = "user_new"
     * )
     * @Rest\View
     */
    public function registration(UserPasswordHasherInterface $passwordHasher,Request $request){

        $user = new User();
        $data = json_decode($request->getContent(), true);
        //dd($data);
        $user->setUsername($data['__username']);
        $user->setPassword($data['__password']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );
        $user->setPassword($hashedPassword);
        $this->documentManager->persist($user);
        $this->documentManager->flush();
        return new JsonResponse(['status' => 'user created!'], Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get (
     * path = "/logout",
     * name = "logout"
     * )
     * @Rest\View
     */
    public function logout(): void{

    }

    /**
     * @Rest\Get (
     * path = "/aaaa",
     * name = "aaaa"
     * )
     * @Rest\View
     */
    public function aaaa(){
        return (['status' => 'aaaa success']);
    }
}