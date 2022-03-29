<?php

namespace App\Repository;

use App\Entity\Player;
use App\Entity\ChessMatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Player $entity, bool $flush = true): void
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
    public function remove(Player $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Player) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return Player[] Returns an array of Player objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Player
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function countBySearch($genderCategories, $ageCategories) {

        $qb = $this->createQueryBuilder('p');
        $qb->where('p.active = 1');

            $qb->andWhere('p.gender IN(:g1) ');
            $qb->andWhere('p.ageCategory IN(:a1) ');
            $qb->setParameter('g1', array_map(fn($it) => $it->value,$genderCategories) );
            $qb->setParameter('a1', array_map(fn($it) => $it->value,$ageCategories) );

        $qb->select('count(p.id)');
//        permet de récupérer une valeur unique et non un objet ou une collection
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByAgeAndGender($genderCategories, $ageCategories)
    {

        $qb = $this->createQueryBuilder('p');
        $qb->where('p.active = 1');

        $qb->andWhere('p.gender IN(:g1) ');
        $qb->andWhere('p.ageCategory IN(:a1) ');
        $qb->setParameter('g1',  array_map(fn($it) => $it->value,$genderCategories));
        $qb->setParameter('a1',  array_map(fn($it) => $it->value,$ageCategories));

//        permet de récupérer une valeur unique et non un objet ou une collection
        return $qb->getQuery()->getResult();
    }
    public function findByAgeAndGender2($genderCategories, $ageCategories)
    {

        $qb = $this->createQueryBuilder('p');
        $qb->where('p.active = 1');

        $qb->andWhere('p.gender IN(:g1) ');
        $qb->andWhere('p.ageCategory IN(:a1) ');
        $qb->setParameter('g1',  $genderCategories);
        $qb->setParameter('a1',  $ageCategories);

//        permet de récupérer une valeur unique et non un objet ou une collection
        return $qb->getQuery()->getResult();
    }
    public function findByMatch($matchId)
    {

        $qb = $this->createQueryBuilder('p');
        $qb->join('App\Entity\ChessMatch','cm', 'with','p.id = cm.player1 where cm.id = :m1');
        $qb->setParameter('m1', $matchId);

        return $qb->getQuery()->getResult();
    }
}
