<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisplayController extends AbstractController
{
    #[Route('/display', name: 'app_display')]
    public function show(EntityManagerInterface $entityManager): Response
    {
         $user = $entityManager -> getRepository(User::class)->findAll();

         if(!$user){
             throw $this->createNotFoundException(
                 'Users not found'
             );
         }

        return $this->render('display/index.html.twig', [
            'users' => $user,
        ]);
    }
}
