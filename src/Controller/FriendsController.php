<?php

namespace App\Controller;

use App\Entity\Friends;
use App\Entity\User;
use App\Repository\FriendsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendsController extends AbstractController
{
    #[Route('/friends', name: 'app_friends')]
    public function index(FriendsRepository $friendsRepository): Response
    {

        return $this->render('friends/index.html.twig', [
            'friends'=>$friendsRepository->findAll(),

        ]);
    }

    #[Route('/friends/add/{username}', name:'app_add_friends', methods: ['POST'])]
    public function add(Request $request, FriendsRepository $friendsRepository, UserRepository $userRepository, EntityManagerInterface $entityManager, $username): Response
    {



        if($request->isMethod('POST')){
            $user = $userRepository->findOneBy(['username' =>  $username]);
            $friends = new Friends();
            $friends->addUser($user);

            $entityManager->persist($friends);
            $entityManager->flush();

            return $this->redirectToRoute('app_friends');
        }

        return $this->render('friends/index.html.twig', [
            'friends'=>$friendsRepository->findAll(),
        ]);

    }
}
