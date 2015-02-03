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
            $duree = $this->getDuree()*60 - $elapsed ;

            return $duree;
        }
        else
        {
            return $this->getDuree();
        }
    }



    public function toArray()
    {
        
        return array(
            'team1' => $this->getTeam1(),
            'team2' => $this->getTeam2(),
            'score1' => $this->getScore1(),
            'score2' => $this->getScore2(),
            'heureDepart' => $this->getHeureDepart(),
            'duree' => $this->getDuree(),
            'etat' => $this->getEtat(),
            'timeLeft' => $this->getTimeLeft()
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
     * Get teamB_id
     *
     * @return integer 
     */
    public function getTeamB()
    {
        return $this->teamB;
    }

}
