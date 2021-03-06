<?php

namespace ScoreBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ScoreBoardBundle\Entity\MatchsRepository")
 */
class Matchs
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
     * @var integer
     *
     * @ORM\Column(name="score1", type="integer")
     */
    private $score1;

    /**
     * @var integer
     *
     * @ORM\Column(name="score2", type="integer")
     */
    private $score2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDepart", type="datetime")
     */
    private $heureDepart;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer")
     */
    private $duree;


     /**
     * @var integer
     *
     * @ORM\Column(name="dureeMatch", type="integer")
     */
    private $dureeMatch;


    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean")
     */
    private $etat;

    /**
   * @ORM\ManyToOne(targetEntity="ScoreBoardBundle\Entity\Team")
   * @ORM\JoinColumn(nullable=false)
   */
  private $teamA;

    /**
   * @ORM\ManyToOne(targetEntity="ScoreBoardBundle\Entity\Team")
   * @ORM\JoinColumn(nullable=false)
   */
  private $teamB;


    /**
   * @ORM\ManyToOne(targetEntity="ScoreBoardBundle\Entity\Tournament")
   * @ORM\JoinColumn(nullable=true)
   */
    private $tournament;


    /**
     * @var boolean
     *
     * @ORM\Column(name="finDuMatch", type="boolean")
     */
    private $finDuMatch;

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
     * Set score1
     *
     * @param integer $score1
     * @return Matchs
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
     * @return Matchs
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
     * @param \DateTime $heureDepart
     * @return Matchs
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;
    
        return $this;
    }

    /**
     * Get heureDepart
     *
     * @return \DateTime 
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Matchs
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    
        return $this;
    }

    /**
     * Get dureeMatch
     *
     * @return integer 
     */
    public function getDureeMatch()
    {
        return $this->dureeMatch;
    }

    /**
     * Set dureeMatch
     *
     * @param integer $dureeMatch
     * @return Matchs
     */
    public function setDureeMatch($dureeMatch)
    {
        $this->dureeMatch = $dureeMatch;
    
        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }


    /**
     * Set etat
     *
     * @param boolean $etat
     * @return Matchs
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }


    public function getTimeLeft()
    {
        if ($this->getEtat()==1)
        {
            $now = new \DateTime;
            $elapsed = $now->getTimestamp()-$this->getHeureDepart()->getTimestamp();
            $duree = $this->getDuree() - $elapsed ;

            return $duree;
        }
        else
        {
            return $this->getDuree();
        }
    }

    private $tbEvents = array();
   
    public function getEvents()
    {   

        return $this->tbEvents;
    }

    public function setEvents($event)
    {
      
        $this->tbEvents[]=$event;
        return $this->tbEvents;
    }



    public function toArray()
    {
        
        return array(
            'team1' => $this->getTeamA(),
            'team2' => $this->getTeamB(),
            'score1' => $this->getScore1(),
            'score2' => $this->getScore2(),
            'heureDepart' => $this->getHeureDepart(),
            'duree' => $this->getDuree(),
            'etat' => $this->getEtat(),
            'timeLeft' => $this->getTimeLeft(),
            'event' => $this->getEvents(),
            'finDuMatch' => $this->getFinDuMatch()
        );
     }
    /**
     * Get teamA_id
     *
     * @return integer 
     */
    public function getTeamA()
    {
        return $this->teamA;
    }

       /**
     * Set teamA
     *
     * @param boolean $teamA
     * @return Matchs
     */
    public function setTeamA($teamA)
    {
        $this->teamA = $teamA;
    
        return $this;
    }

    /**
     * Get teamB_id
     *
     * @return integer 
     */
    public function getTeamB()
    {
        return $this->teamB;
    }

           /**
     * Set teamB
     *
     * @param boolean $teamV
     * @return Matchs
     */
    public function setTeamB($teamB)
    {
        $this->teamB = $teamB;
    
        return $this;
    }

    /**
     * Set tournament
     *
     * @param string $tournament
     * @return Team
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;
    
        return $this;
    }

    /**
     * Get tournament
     *
     * @return string
     */
    public function getTournament()
    {
        return $this->tournament;
    }


    /**
     * Set finDuMatch
     *
     * @param boolean $finDuMatch
     * @return Matchs
     */
    public function setFinDuMatch($finDuMatch)
    {
        $this->finDuMatch = $finDuMatch;
    
        return $this;
    }

    /**
     * Get finDuMatch
     *
     * @return boolean 
     */
    public function getFinDuMatch()
    {
        return $this->finDuMatch;
    }

}
