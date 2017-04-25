<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Coach;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Coach", mappedBy="user")
     */
    private $coach;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set user
     *
     * @param Coach $user
     *
     * @return User
     */
    public function setCoach(Coach $coach = null)
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * Get user
     *
     * @return Coach
     */
    public function getCoach()
    {
        return $this->coach;
    }
}
