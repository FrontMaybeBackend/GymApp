<?php

namespace App\Controller;

use App\Entity\Invitations;
use App\Entity\User;
use App\Repository\InvitationsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class InvitationsController extends AbstractController
{
    #[Route('/invitations/show', name: 'app_invitations')]
    public function show(InvitationsRepository $invitationsRepository): Response
    {
        $loggedUser = $this->getUser();

        $invitations = $invitationsRepository->findBy(['receiver'=>$loggedUser]);


        return $this->render('invitations/index.html.twig', [
            'invitations' => $invitations,

        ]);
    }
}
