<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByUsernameOrEmail(string $username): User
    {
        return $this->createQueryBuilder('u')
             ->where('u.username = :username OR u.email = :email')
             ->setParameter('username', $username)
             ->setParameter('email', $username)
             ->getQuery()
             ->getOneOrNullResult();
    }
}
