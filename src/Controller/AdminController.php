<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/administrator', name: 'admin_home')]
    public function index(): Response
    {
        return $this->render('admin/index_admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
