<?php

namespace App\Repository;

use App\Entity\Friends;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Friends>
 *
 * @method Friends|null find($id, $lockMode = null, $lockVersion = null)
 * @method Friends|null findOneBy(array $criteria, array $orderBy = null)
 * @method Friends[]    findAll()
 * @method Friends[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Friends::class);
    }

    public function save(Friends $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Friends $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @throws Exception
     */
    public function findFriends(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT f.username AS friend_username
                FROM user u
                INNER JOIN friends_user fu ON u.id = fu.user_id
                INNER JOIN friends f ON fu.friends_id = f.id
                WHERE u.id = :id; ';

        $resultSet = $conn->executeQuery($sql,['id'=>$id]);

        return $resultSet->fetchAllAssociative();
    }

   /* /**
     * @return Friends[] Returns an array of Friends objects
     */
   /* public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.username= :username')
            ->setParameter('username', $value)
            ->getQuery()
            ->getResult()
        ;
   }
*/
//    public function findOneBySomeField($value): ?Friends
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
