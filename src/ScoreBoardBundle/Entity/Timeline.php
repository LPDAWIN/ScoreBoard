<?php

namespace ScoreBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timeline
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ScoreBoardBundle\Entity\TimelineRepository")
 */
class Timeline
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="event", type="string", length=255)
     */
    private $event;

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer")
     */
    private $time;


    /**
     * @ORM\ManyToOne(targetEntity="ScoreBoardBundle\Entity\Matchs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $match;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * Set event
     *
     * @param string $event
     * @return Timeline
     */
    public function setEvent($event)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return string 
     */
    public function getEvent()
    {
        return $this->event;
    }


    /**
     * Set match
     *
     * @param integer $match
     * @return Timeline
     */
    public function setMatch($match)
    {
        $this->match = $match;
    
        return $this;
    }

    /**
     * Get match
     *
     * @return integer 
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return Timeline
     */
    public function setTime($time)
    {
        $this->time = $time;
    
        return $this;
    }

    /**
     * Get time
     *
     * @return integer 
     */
    public function getTime()
    {
        return $this->time;
    }





}
