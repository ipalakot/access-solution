<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\User;
use App\Form\UtilisateurType;
use App\FormUserType;
use App\Repository\UtilisateurRepository;
use App\repositoryUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[ Route( '/utilisateur' ) ]

class UtilisateurController extends AbstractController {
    #[ Route( '/', name: 'utilisateur_index', methods: [ 'GET' ] ) ]

    public function index( UtilisateurRepository $utilisateurRepository, Request $request ): Response {
        $utilisateurs = $utilisateurRepository->findBy( [ 'user' => $this->getUser() ] );

        return $this->render( 'pages/utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ] );
    }

    #[ Route( '/new', 'utilisateur_new', methods: [ 'GET', 'POST' ] ) ]

    public function new( Request $request, EntityManagerInterface $manager ): Response {
        $utilisateur = new Utilisateur();
        $form = $this->createForm( UtilisateurType::class, $utilisateur );

        $form->handleRequest( $request );
        if ( $form->isSubmitted() && $form->isValid() ) {
            $utilisateur = $form->getData();
            $utilisateur->setUser( $this->getUser() );

            $manager->persist( $utilisateur );
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre utilisateur a été créé avec succès !'
            );

            return $this->redirectToRoute( 'utilisateur.index' );
        }

        return $this->render( 'pages/utilisateur/new.html.twig', [
            'form' => $form->createView()
        ] );
    }

    #[ Route( '/{id}', name: 'utilisateur_show', methods: [ 'GET' ] ) ]

    public function show( Utilisateur $utilisateur ): Response {
        return $this->render( 'pages/utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ] );
    }

    #[ Route( '/{id}/edit', name: 'utilisateur_edit', methods: [ 'GET', 'POST' ] ) ]

    public function edit( Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager ): Response {
        $form = $this->createForm( UtilisateurType::class, $utilisateur );
        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {
            $entityManager->flush();

            return $this->redirectToRoute( 'utilisateur_index', [], Response::HTTP_SEE_OTHER );
        }

        return $this->render( 'pages/utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ] );
    }

    #[ Route( '/{id}', name: 'app_utilisateur_delete', methods: [ 'POST' ] ) ]

    public function delete( Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager ): Response {
        if ( $this->isCsrfTokenValid( 'delete'.$utilisateur->getId(), $request->request->get( '_token' ) ) ) {
            $entityManager->remove( $utilisateur );
            $entityManager->flush();
        }

        return $this->redirectToRoute( 'utilisateur_index', [], Response::HTTP_SEE_OTHER );
    }
}
