<?php

namespace App\Repository;

use App\Entity\Product;
use App\Query\Trait\PaginatorTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Query\Product\FullSearchQuery;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Security\Core\Security;

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