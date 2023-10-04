<?php

namespace App\Controller;

use App\Entity\Friends;
use App\Entity\Invitations;
use App\Entity\User;
use App\Repository\FriendsRepository;
use App\Repository\InvitationsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class InvitationsController extends AbstractController
{
    #[Route('/invitations/show', name: 'app_invitations')]
    public function index(InvitationsRepository $invitationsRepository): Response
    {
        $loggedUser = $this->getUser();

        $invitations = $invitationsRepository->findBy(['receiver'=>$loggedUser]);


        return $this->render('invitations/index.html.twig', [
            'invitations' => $invitations,

        ]);
    }

    //Przyjmuje zapro do znajomych
    #[Route('/invitations/accept/{id}', name:'app_invitations_accept')]
    public function accept(Request $request,int $id, EntityManagerInterface $entityManager): Response
    {
        if($request->isMethod('GET')){
            $status= $entityManager->getRepository(Invitations::class)->find($id);
            $status->setStatus('przyjęte');
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_friends');
    }

    //Odrzuca zapro do znajomych
    #[Route('/invitations/rejected/{id}', name:'app_invitations_rejected')]
    public function rejected(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {

        if($request->isMethod('GET')){

            $status = $entityManager->getRepository(Invitations::class)->find($id);
            $status->setStatus('odrzucone');
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_friends');
    }

}
