<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    #[Template('home/index.html.twig')]
    public function home(): array
    {
        return[

        ];
    }

    #[Route('/about-us', name: 'about_us')]
    #[Template('home/about_us.html.twig')]
    public function aboutUs(): array
    {
        return[

        ];
    }

    #[Route('/contact-us', name: 'contact_us')]
    #[Template('home/contact_us.html.twig')]
    public function contactUs(): array
    {
        return[

        ];
    }
}
