<?php

namespace ScoreBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match2
 */
class Matchs
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $team1;

    /**
     * @var string
     */
    private $team2;

    /**
     * @var integer
     */
    private $score1;

    /**
     * @var integer
     */
    private $score2;

    /**
     * @var time
     */
    private $heureDepart;

    /**
     * @var time
     */
    private $duree;

    /**
     * @var boolean
     */
    private $etat;

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
     * Set team1
     *
     * @param string $team1
     * @return Match2
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return string 
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param string $team2
     * @return Match2
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return string 
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set score1
     *
     * @param integer $score1
     * @return Match2
     */
    public function setScore1($score1)
    {
        $this->score1 = $score1;

        return $this;
    }

    /**
     * Get score1
     *
     * @return integer 
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * Set score2
     *
     * @param integer $score2
     * @return Match2
     */
    public function setScore2($score2)
    {
        $this->score2 = $score2;

        return $this;
    }

    /**
     * Get score2
     *
     * @return integer 
     */
    public function getScore2()
    {
        return $this->score2;
    }

    /**
     * Set heureDepart
     *
     * @param time $heureDepart
     * @return Match2
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    /**
     * Get heureDepart
     *
     * @return string 
     */
    public function getHeureDepart()
    {
        return date("H:i:s", $this->heureDepart->getTimestamp());
    }

        /**
     * Set duree
     *
     * @param time $heureDepart
     * @return Match2
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string 
     */
    public function getDuree()
    {
        return date("H:i:s", $this->duree->getTimestamp());
    }





}
