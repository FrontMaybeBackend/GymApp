<?php

namespace App\Controller;

use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StarterPageController extends AbstractController
{
    #[Route('/starter/page', name: 'app_starter_page')]
    public function index(UserRepository $userRepository, TrainingRepository $trainingRepository,): Response
    {
            //Wyswietlenie liczby userow
        $users =$userRepository->findAll();
        $numberOfUsers = count($users);

        $trainings = $trainingRepository->findAll();
        $numberOfTrainings = count($trainings);

        return $this->render('starter_page/index.html.twig', [
            'controller_name' => 'StarterPageController',
            'numberOfUsers'=>$numberOfUsers,
            'users'=> $users,
            'trainings'=>$trainingRepository,
            'numberOfTrainings'=>$numberOfTrainings,
        ]);


    }

}
