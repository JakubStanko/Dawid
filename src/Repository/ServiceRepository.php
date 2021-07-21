<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ServiceRepository extends EntityRepository
{
    public function findAllTest()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM App:Service p'
            )
            ->getResult();
    }
}