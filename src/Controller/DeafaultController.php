<?php
namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeafaultController extends AbstractController
{

    #[Route('/', 'deafault_index', methods: [
        'GET'
    ])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('deafault/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }

    #[Route('/about', 'home_about', methods: [
        'GET'
    ])]
    public function about(ProductRepository $productRepository): Response
    {
        return $this->render('deafault/about.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }

    #[Route('/contact', name: 'contact_index')]
    public function contact(): Response
    {
        return $this->render('deafault/contact.html.twig', [
            'controller_name' => 'ContactController'
        ]);
    }
}
