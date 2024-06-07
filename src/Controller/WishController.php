<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name: 'wish_')]

class WishController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly WishRepository         $wishRepository,
    )
    {
    }

    #[Route('/', name: 'list')]
    #[Template('wish/user_list.html.twig')]
    public function list(): array
    {
        $wishes = $this->wishRepository->findAll();

        return [
            'wishes' => $wishes
        ];
    }

    #[Route('/detail/{id}', name: 'detail')]
    #[Template('wish/detail.html.twig')]
    public function detail(Wish $wish): array
    {
        $category = $wish->getCategory()->getName();
        return [
            'wish' => $wish,
            'category' => $category
        ];
    }

    #[Route('/add', name: 'add')]
    #[Template('wish/form.html.twig')]
    public function create(Request $request): Response | array
    {
        $wish = new Wish();

        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(WishType::class, $wish, ['username' => $user->getUsername()]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $wish->setCreatedAt(new \DateTimeImmutable());
            $this->entityManager->persist($wish);
            $this->entityManager->flush();

            return $this->redirectToRoute('wish_list');
        }

        return [
            'form' => $form
        ];
    }

    #[Route('/edit/{id}', name: 'edit')]
    #[Template('wish/form.html.twig')]
    public function edit(Wish $wish, Request $request): Response | array
    {
        $wish = $this->wishRepository->find($wish->getId());

        $form = $this->createForm(WishType::class, $wish);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($wish);
            $this->entityManager->flush();
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return [
            'form' => $form
        ];
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Wish $wish): Response
    {
        $this->entityManager->remove($wish);
        $this->entityManager->flush();

        return $this->redirectToRoute('wish_list');
    }
}
