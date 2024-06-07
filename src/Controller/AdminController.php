<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/user-list', name: 'user_list')]
    #[Template('/admin/user_list.html.twig')]
    public function index(UserRepository $userRepository): array
    {
        $users = $userRepository->findAll();

        return [
            'users' => $users
        ];
    }

    #[Route('/add-user', name: 'add_user')]
    public function addUser(): Response
    {
        return $this->redirectToRoute('register');
    }

}
