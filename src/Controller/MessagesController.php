<?php

namespace App\Controller;


use App\Entity\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MessagesController extends AbstractController
{
    #[Route('/messages/', name: 'app_messages_send', methods: 'POST')]
    public function add(Request $request, EntityManagerInterface $entityManager, UserInterface $user): Response
    {

        if ($request->isMethod('POST')) {
            $user->getUserIdentifier();
            $username = $user->getUsername();

            $message = new Messages();
            $message->setFromUser($username);
            $message->setToUser($_POST['toUser']);
            $message->setTitle($_POST['title']);
            $message->setDescription($_POST['description']);
            $entityManager->persist($message);
            $entityManager->flush();

            flash()->addSuccess('Message already send');

        }

        return $this->render('starter_page/index.html.twig');
    }
}
