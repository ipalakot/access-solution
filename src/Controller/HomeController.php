<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('pages/home_index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }

    #[Route('/about', name: 'about_index', methods: ['GET'])]
    public function aboutA(ProductRepository $productRepository): Response
    {
        return $this->render('pages/home/about.html.twig', [
            'products' => $productRepository->findAll()

        ]);
    }
}
