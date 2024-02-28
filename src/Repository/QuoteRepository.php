<?php

namespace App\Repository;

use App\Entity\Quote;
use App\Query\Trait\PaginatorTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Query\Quote\FullSearchQuery;
use Doctrine\ORM\Tools\Pagination\Paginator;



/**
 * @extends ServiceEntityRepository<Quote>
 *
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findAll()
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteRepository extends ServiceEntityRepository
{
    use PaginatorTrait;

    private FullSearchQuery $fullSearchQuery;

    public function __construct(ManagerRegistry $registry,FullSearchQuery $fullSearchQuery) {
        parent::__construct($registry, Quote::class);
        $this->fullSearchQuery = $fullSearchQuery;
    }

    public function findByMonth(\DateTimeInterface $date): array
    {
        $startDate = new \DateTime($date->format('Y-m-01 00:00:00'));
        $endDate = new \DateTime($date->format('Y-m-t 23:59:59'));

        return $this->createQueryBuilder('q')
            ->andWhere('q.quoteIssuanceDate BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getResult();
    }

    // Méthode pour trouver les devis par semaine
    public function findByWeek(\DateTimeInterface $date): array
    {
        $startDate = new \DateTime($date->format('Y-m-d 00:00:00'));
        $endDate = new \DateTime($date->format('Y-m-d 23:59:59'));
        $startDate->modify('last monday');
        $endDate->modify('next sunday');

        return $this->createQueryBuilder('q')
            ->andWhere('q.quoteIssuanceDate BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getResult();
    }

    // Méthode pour trouver les devis par jour
    public function findByDay(\DateTimeInterface $date): array
    {
        $startDate = new \DateTime($date->format('Y-m-d 00:00:00'));
        $endDate = new \DateTime($date->format('Y-m-d 23:59:59'));

        return $this->createQueryBuilder('q')
            ->andWhere('q.quoteIssuanceDate BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getResult();
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
    {
        $query = $this
            ->createQueryBuilder('c')
            ->getQuery();

        $this->decoratePaginator($query, $page, $limit); 

        return new Paginator($query);
    }

    public function findLastQuote(): ?Quote
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findQuoteByNumber(?string $quoteNumber = ''): ?Quote
    {
        if (empty($quoteNumber)) {
            return null;
        }
        return $this->createQueryBuilder('q')
            ->andWhere('q.quote_number = :quoteNumber')
            ->setParameter('quoteNumber', $quoteNumber)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
