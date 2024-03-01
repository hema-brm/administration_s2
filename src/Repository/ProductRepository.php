<?php

namespace App\Repository;

use App\DTO\SearchDto;
use App\Entity\Product;
use App\Query\Trait\PaginatorTrait;
use App\Query\Product\FullSearchQuery;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Security\Core\Security;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    use PaginatorTrait;
    private FullSearchQuery $fullSearchQuery;
    private $user;

    public function __construct(ManagerRegistry $registry, FullSearchQuery $fullSearchQuery, Security $security)
    {
        parent::__construct($registry, Product::class);
        $this->fullSearchQuery = $fullSearchQuery;
        $this->user = $security->getUser();
    }

    public function _search(?SearchDto $searchDto, int $page = 1, int $limit = 10){
        $queryBuilder = $this
                        ->createQueryBuilder('p')
                        ->leftJoin('p.company', 'c')
                        ->leftJoin('p.category', 'category')
                        ->andWhere('LOWER(p.name) LIKE LOWER(:search)')
                        ->orWhere('LOWER(category.name) LIKE LOWER(:search)')
                        ->orWhere('LOWER(p.reference) LIKE LOWER(:search)')
                        ->orWhere('LOWER(p.description) LIKE LOWER(:search)')
                        ->setParameter('search', '%' . $searchDto?->getSearch() . '%');
        
        if($this->user){
            $queryBuilder->andWhere('p.company = :company')
                         ->setParameter('company', $this->user->getCompany());
        }
        
        $queryBuilder =  $queryBuilder->getQuery();
        $this->decoratePaginator($queryBuilder, $page, $limit);
        return new Paginator($queryBuilder);
    }

    public function search(string $search, int $page = 1, int $limit = 10): Paginator 
    {
        $query = $this->fullSearchQuery
            ->withTerm($search)
            ->get();

        $this->decoratePaginator($query, $page, $limit);

        return new Paginator($query);
    }

    public function findAllWithPage(int $page = 1, int $limit = 10): Paginator
    {   //c est un alias correspondant ici à product 
        $query = $this->createQueryBuilder('c');
        //requete sql, company sera specifie via setParameter
        $query->andWhere('c.company = :company')
              ->setParameter('company', $this->user->getCompany());
        
        $query = $query->getQuery();

        $this->decoratePaginator($query, $page, $limit); 

        return new Paginator($query);
    }

    public function getFirstProduct()
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}