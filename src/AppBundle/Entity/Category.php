<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Coach;
use AppBundle\Entity\Event;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;


    /**
     * @ORM\OneToMany(targetEntity="Coach", mappedBy="category")
     */
    private $coaches;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="category")
     */
    private $events;


    public function __construct()
    {
        $this->coaches = new ArrayCollection();
        $this->events = new ArrayCollection();
    }


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
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add coach
     *
     * @param Coach $coach
     *
     * @return Category
     */
    public function addCoach(Coach $coach)
    {
        $this->coaches[] = $coach;

        return $this;
    }

    /**
     * Remove coach
     *
     * @param Coach $coach
     */
    public function removeCoach(Coach $coach)
    {
        $this->coaches->removeElement($coach);
    }

    /**
     * Get coaches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoaches()
    {
        return $this->coaches;
    }

    /**
     * Add event
     *
     * @param Event $event
     *
     * @return Category
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    public function __toString()
    {
        return $this->title;
    }
}
