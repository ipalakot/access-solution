<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
* @extends ServiceEntityRepository<Product>
*
* @method Product|null find( $id, $lockMode = null, $lockVersion = null )
* @method Product|null findOneBy( array $criteria, array $orderBy = null )
* @method Product[]    findAll()
* @method Product[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
*/

class ProductRepository extends ServiceEntityRepository {
    public function __construct( ManagerRegistry $registry,
    private PaginatorInterface $paginatorInterface ) {
        parent::__construct( $registry, Product::class );
    }

    /**
    * recupère les products en lien avec une recherche
    *
    * @return Product[] Returns an array of Product objects
    */

    /**
    * Récupère les produits liés à une recherche.
    *
    * @param SearchData $searchData
    * @return PaginationInterface
    */

    public function findSearch( SearchData $searchData ): PaginationInterface {
        // Crée un constructeur de requête avec l'alias 'p' (pour produit)
    $queryBuilder = $this->createQueryBuilder('p')
        ->select('c', 'p')  // Sélectionne les catégories et les produits
        ->join('p.category', 'c');  // Effectue une jointure avec la table des catégories

    // Vérifie si le champ de recherche n'est pas vide
        if ( !empty( $searchData->q ) ) {
            $queryBuilder
            ->andWhere( 'p.name LIKE :q' )  // Ajoute une condition pour le nom du produit
            ->setParameter( 'q', "%{$searchData->q}%" );
            // Paramètre la valeur en utilisant le paramètre nommé :q
        }

        // Vérifie si la valeur minimale est spécifiée
        if ( !empty( $searchData->min ) ) {
            $queryBuilder
            ->andWhere( 'p.price >= :min' )  // Ajoute une condition pour le prix minimum
            ->setParameter( 'min', $searchData->min );
            // Paramètre la valeur minimale
        }

        // Vérifie si la valeur maximale est spécifiée
        if ( !empty( $searchData->max ) ) {
            $queryBuilder
            ->andWhere( 'p.price <= :max' )  // Ajoute une condition pour le prix maximum
            ->setParameter( 'max', $searchData->max );
            // Paramètre la valeur maximale
        }

        // Récupère la requête construite
        $query = $queryBuilder->getQuery();

        // Utilise le Paginator pour paginer les résultats de la requête
        $pagination = $this->paginatorInterface->paginate(
            $query,
            $searchData->page,
            9  // Nombre d'éléments par page
    );

    // Retourne les résultats paginés
    return $pagination;
}


    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */

    // tous les artticles de la categorie informatique

    public function findByCategoryinformatique() {
        $qb = $this->createQueryBuilder( 'p' );

        $qb
        ->innerJoin( 'App\Entity\category', 'c', 'WITH', 'c = p.category' )
        ->where( 'p.createdAt IS NOT NULL' )
        ->andWhere( 'c.title like :title' )
        ->setParameter( 'title', 'informatique' )
        ->orderBy( 'p.title', 'ASC' );

        // dump( $qb->getQuery()->getResult() );

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */

    //    public function findByExampleField( $value ): array
    // {
    //        return $this->createQueryBuilder( 'p' )
    //            ->andWhere( 'p.exampleField = :val' )
    //            ->setParameter( 'val', $value )
    //            ->orderBy( 'p.id', 'ASC' )
    //            ->setMaxResults( 10 )
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    /**
    //     * @return product[] Returns an array of Product objects
    //     */
    //    public function findOneBySomeField( $value ): ?Product
    // {
    //        return $this->createQueryBuilder( 'p' )
    //            ->andWhere( 'p.exampleField = :val' )
    //            ->setParameter( 'val', $value )
            //            ->getQuery()
            //            ->getOneOrNullResult()
            //        ;
            //    }
        }
