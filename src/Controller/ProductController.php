<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Image;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[ Route( '/product' ) ]

class ProductController extends AbstractController {
    #[ Route( '/', name: 'product_index', methods: [ 'GET' ] ) ]

    public function index(
        ProductRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $products = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt( 'page', 1 ),
            10
        );

        return $this->render( 'pages/product/index.html.twig', [
            'products' => $products,
        ] );
    }

    #[ Route( '/new', name: 'product_new', methods: [ 'GET', 'POST' ] ) ]

    public function newProduct( Request $request, EntityManagerInterface $manager ): Response {
        $product = new Product();

        $form = $this->createForm( ProductType::class, $product );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {
            // Gestion des ImageOfProduct pour un product
            // Je récupère les ImageOfProduct transmises depuis le formulaire à travers 1 products et je vais chercher les données( getData )
            $imageShop = $form->get( 'imageShop' )->getData();
            // Assurez-vous que le nom du champ correspond à celui de votre formulaire

            // On boucle sur les ImageOfProduct ( lorsque j'ai plusieurs ImageOfProduct)
            foreach ($imageShop as $image) {
                // On génère un nouveau nom de fichier pour éviter que 2 fichiers aient le même nom
                $fichier = md5(uniqid()) . '.' . $image->guessExtension(); // guessExtension récupère l'extension du fichier

            // On passe le fichier dans le dossier uploads
            // Stockage de l'image sur le disque (l'image physique )
            $image->move(
                $this->getParameter( 'images_directory' ), // Assurez-vous que le nom du paramètre correspond à celui de votre configuration
                $fichier
            );

            // On va alors stocker ( le nom de l'image) dans la base de données
                $img = new Image();
                $img->setTitle($fichier);
                $product->addimageShop($img);
            }

            $manager->persist($product);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre article a été créé avec succès !'
            );

            return $this->redirectToRoute('product_index', ['id' => $product->getId()]); // Redirection vers l'product
        }

        return $this->render(
            'pages/product/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    #[ Route( '/{id}', name: 'product_show', methods: [ 'GET' ] ) ]

    public function show( Product $product ): Response {
        return $this->render( 'pages/product/show.html.twig', [
            'product' => $product,
        ] );
    }

    #[ Route( '/{id}/edit', name: 'product_edit', methods: [ 'GET', 'POST' ] ) ]

    public function edit( Request $request, Product $product, EntityManagerInterface $entityManager ): Response {
        $form = $this->createForm( ProductType::class, $product );
        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {
            $entityManager->flush();

            return $this->redirectToRoute( 'product_index', [], Response::HTTP_SEE_OTHER );
        }

        return $this->renderForm( 'pages/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ] );
    }

    #[ Route( '/{id}', name: 'product_delete', methods: [ 'POST' ] ) ]

    public function delete( Request $request, Product $product, EntityManagerInterface $entityManager ): Response {
        if ( $this->isCsrfTokenValid( 'delete' . $product->getId(), $request->request->get( '_token' ) ) ) {
            $entityManager->remove( $product );
            $entityManager->flush();
        }

        return $this->redirectToRoute( 'product_index', [], Response::HTTP_SEE_OTHER );
    }
}