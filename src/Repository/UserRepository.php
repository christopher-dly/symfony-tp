<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, User::class);
    }

    public function sauvegarder(User $nouveauUser, ?bool $flush = false)
    {

        $this->getEntityManager()->persist($nouveauUser);

        if ($flush) {

            $this->getEntityManager()->flush();
        }

        return $nouveauUser;
    }
}
