<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Coach;
use AppBundle\Entity\User;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllByTitle($title, $city = '')
    {
        $query = $this->createQueryBuilder('event')
            ->leftJoin('event.city', 'ecity')
            ->andWhere('event.title LIKE :title')
            ->setParameter('title', '%' . $title . '%');

        if ($city) {
            $query->andWhere('ecity.title = :city')
                ->setParameter('city', $city);
        }

        return $query->orderBy('event.date', 'DESC')
            ->getQuery()
            ->execute();
    }

    public function findAllOrderByDate()
    {
        return $this->createQueryBuilder('event')
            ->orderBy('event.date', 'DESC')
            ->getQuery()
            ->execute();
    }

    public function findUserEvents(User $user)
    {
        return $this->createQueryBuilder('event')
            ->andWhere(':user MEMBER OF event.attendees')
            ->setParameter(':user', $user)
            ->getQuery()
            ->execute();
    }

    public function findCoachEvents(Coach $coach)
    {
        return $this->createQueryBuilder('event')
            ->andWhere('event.coach=:coach')
            ->setParameter(':coach', $coach)
            ->getQuery()
            ->execute();
    }
}
