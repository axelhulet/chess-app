<?php

namespace App\Repository;

use App\Entity\ChessMatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChessMatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChessMatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChessMatch[]    findAll()
 * @method ChessMatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChessMatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChessMatch::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ChessMatch $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ChessMatch $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ChessMatch[] Returns an array of ChessMatch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChessMatch
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findPlayersByMatch($matchId)
    {
        $qb = $this->createQueryBuilder('m');
        $qb->select('m.player1');
        $qb->where('m.id = 95');
        $qb->setParameter('m1', $matchId);

        return $qb->getQuery()->getResult();

    }
}
