<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;
use AppBundle\Entity\Event;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Viršijote leistiną simbolių skaičių ribą {{ limit }}"
     * )
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAtDate", type="datetime")
     */
    private $createdAtDate;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="comments")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAtDate
     *
     * @param \DateTime $createdAtDate
     *
     * @return Comment
     */
    public function setCreatedAtDate($createdAtDate)
    {
        $this->createdAtDate = $createdAtDate;

        return $this;
    }

    /**
     * Get createdAtDate
     *
     * @return \DateTime
     */
    public function getCreatedAtDate()
    {
        return $this->createdAtDate;
    }

    /**
     * Set event
     *
     * @param Event $event
     *
     * @return Comment
     */
    public function setEvent(Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    public function __toString()
    {
        return $this->content;
    }
}
