<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
