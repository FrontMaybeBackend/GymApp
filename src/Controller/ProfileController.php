<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileForm;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $profile = $entityManager -> getRepository(User::class)->find($id);

        if (!$profile) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }


        return $this->render('profile/index.html.twig', [
            'profile' => $profile,
        ]);
    }

    #[Route('/profile/{id}/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, User $user, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();

        $form = $this->createForm(UserProfileForm::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form ->isValid()){
            $data = $form->getData();

            $user->setUsername($data['username']);
            $user->setPassword(password_hash($data['password'],PASSWORD_DEFAULT));
            $user->setEmail($data['email']);
            $user->setDescription($data['description']);
            $user->setWorkout($data['workout']);
            $user->setTrainingDays($data['trainingDays']);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/edit_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
