<?php

namespace App\Controller;


use App\Entity\Messenger;
use App\Form\MessengerType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MessengerController extends AbstractController
{
    #[Route('/messenger', name: 'app_messenger')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserInterface $user,UserRepository $allUsers): Response
    {
        $message = new Messenger();
        $toUsers = $allUsers->findAll();
        $form = $this->createForm(MessengerType::class,$message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $message->setFromUser($user);
            $message->setToUsers($toUsers);
            $message->setTitle($form->get('title')->getData());
            $message->setDescription($form->get('description')->getData());

            $entityManager->persist($message);
            $entityManager->flush();
        }
        return $this->render('messenger/index.html.twig', [
            'form' => $form,
        ]);
    }
}
