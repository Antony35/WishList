<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WishController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private readonly WishRepository $wishRepository,
    )
    {
    }

    #[Route('/', name: 'home')]
    #[Template('wish/index.html.twig')]
    public function index(): array
    {
        $wishes = $this->wishRepository->findAll();

        return [
            'wishes' => $wishes
         ];
    }

    #[Route('/create', name: 'create')]
    #[Template('wish/form.html.twig')]
    public function create(Request $request): Response | array
    {
        $wish = new Wish();

        $form = $this->createForm(WishType::class, $wish);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $wish->setCreatedAt(new \DateTimeImmutable());
            $this->entityManager->persist($wish);
            $this->entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return [
            'form' => $form
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
            return $this->redirectToRoute('home');
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

        return $this->redirectToRoute('home');
    }
}
