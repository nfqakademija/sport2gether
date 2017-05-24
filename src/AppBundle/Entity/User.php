<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Comment;

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

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author")
     */
    private $comments;

    public function __construct()
    {
        parent::__construct();
        // your own logic

        $this->comments = new ArrayCollection();
    }

    /**
     * Set user
     *
     * @param Coach $coach
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

    /**
     * Add comment
     *
     * @param Comment $comment
     *
     * @return User
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
