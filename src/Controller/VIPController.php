<?php

namespace App\Controller;

use App\Entity\People;
use App\Form\VIPType;
use App\Repository\PeopleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VIPController extends AbstractController
{
//    private EntityManagerInterface $entityManager;
//    private PeopleRepository $peopleRepository;
//
//    public function __construct(EntityManagerInterface $entityManager, PeopleRepository $peopleRepository)
//    {
//        $this->entityManager = $entityManager;
//        $this->peopleRepository = $peopleRepository;
//    }
//
//    #[Route('/', name: 'home')]
//    #[Template('vip/user_list.html.twig')]
//    public function index(Request $request): Response|array
//    {
//        $peoples = $this->peopleRepository->findAll();
//
//        $form = $this->createForm(VIPType::class, new People());
//
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $people = $form->getData();
//            $this->entityManager->persist($people);
//            $this->entityManager->flush();
//
//            return $this->redirectToRoute('home');
//        }
//
//        return [
//            'peoples' => $peoples,
//            'form' => $form
//        ];
//    }
//
//    #[Route('/edit/{id}', name: 'edit')]
//    #[Template('vip/edit.html.twig')]
//    public function edit(int $id, Request $request): Response|array
//    {
//        $people = $this->entityManager->getRepository(People::class)->find($id);
//
//        if (!$people) {
//            throw $this->createNotFoundException(
//                'No people found for id '.$id
//            );
//        }
//
//        $form = $this->createForm(VIPType::class, $people);
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $people = $form->getData();
//            $this->entityManager->persist($people);
//            $this->entityManager->flush();
//
//            return $this->redirectToRoute('home');
//        }
//
//        return [
//            'form' => $form
//        ];
//    }
//
//    #[Route('/delete/{id}', name: 'delete')]
//    public function delete(int $id): Response
//    {
//        $people = $this->entityManager->getRepository(People::class)->find($id);
//
//        if (!$people) {
//            throw $this->createNotFoundException(
//                'No people found for id '.$id
//            );
//        }
//
//        $this->entityManager->remove($people);
//        $this->entityManager->flush();
//
//        return $this->redirectToRoute('home');
//    }
}
