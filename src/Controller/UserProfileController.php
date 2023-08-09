<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/user/profile')]
class UserProfileController extends AbstractController
{
    #[Route('/', name: 'app_user_profile_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    #[Route('/user/profile/{username}', name: 'app_user_profile_show', methods: ['GET'])]
    public function show(User $user): Response
    {

        $getAvatar = $user->getAvatar();
        $getFullPath = $this->getParameter('avatars_directory'). '/' . $getAvatar;
        return $this->render('user_profile/show.html.twig', [
            'user' => $user,
            'avatar'=>$getFullPath,
        ]);
    }



    #[Route('/{id}/edit', name: 'app_user_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Dodaje avatar do usera, w bazie zapisuje tylko sciezke lub nazwe.
            $file = $form->get('avatar')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('avatars_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $user->setAvatar($newFilename);
            }


            $user->setPassword(password_hash($user->getPassword(),PASSWORD_DEFAULT));
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_profile_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
