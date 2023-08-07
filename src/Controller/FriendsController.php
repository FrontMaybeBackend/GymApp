<?php

namespace App\Controller;

use App\Repository\FriendsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendsController extends AbstractController
{
    #[Route('/friends', name: 'app_friends')]
    public function index(FriendsRepository $friendsRepository,): Response
    {

        return $this->render('friends/index.html.twig', [
            'friends'=>$friendsRepository->findAll(),

        ]);
    }

    #[Route('/friends_add', name:'app_add_friends')]
    public function add(FriendsRepository $friendsRepository, UserRepository $userRepository): Response
    {
        return $this->render('friends/index.html.twig', [
            'friends'=>$friendsRepository->findAll(),

        ]);

    }
}
