<?php

namespace ScoreBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ScoreBoardBundle\Entity\Timeline;
use ScoreBoardBundle\Entity\Team;
use ScoreBoardBundle\Entity\Matchs;
use ScoreBoardBundle\Entity\Tournament;
use ScoreBoardBundle\Form\MatchsType;
use ScoreBoardBundle\Form\TeamType;
use ScoreBoardBundle\Form\TournamentType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class ScoreBoardController extends Controller
{

	public function homeAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		/*$matchs = $em->getRepository("ScoreBoardBundle:Matchs")->findAll();*/

		$matchs = $this
	    ->getDoctrine()
	    ->getManager()
	    ->getRepository('ScoreBoardBundle:Matchs')
	    ->matchsTableau();

		$tournament = $em->getRepository("ScoreBoardBundle:Tournament")->findAll();

		return $this->render('ScoreBoardBundle:Default:home.html.twig', array(
			'matchs'  => $matchs, 'tournament' => $tournament));
	}

	public function matchAction(Matchs $match)
	{


		$request = $this->getRequest();
		$em = $this->getDoctrine()->getEntityManager();
		$match= $em->getRepository("ScoreBoardBundle:Matchs")->find($match->getID());
		$time = $em->getRepository("ScoreBoardBundle:Timeline")->findBy(array('match' => $match->getID()));
		$teamA= $em->getRepository("ScoreBoardBundle:Team")->find($match->getTeamA());
		$teamB= $em->getRepository("ScoreBoardBundle:Team")->find($match->getTeamB());
		



		foreach ($time as $timeline) {
			
			$match->setEvents($timeline->getEvent());
		}	
				
		$now = new \DateTime;
		if($request->getMethod()=='POST'){
			$id = $request->get('id');	
			$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => $id));
			

			$dureeDuMatch = (int)(($update->getDureeMatch() - $update->getTimeLeft())/60);
			
			$timeline = new Timeline();
			if(!$update->getFinDuMatch())
			{	
				if($update->getDuree()!=0){
					if($request->get('btn')=='more1'){
						$score = $update->getScore1();
						$score += 1;
						$update->setScore1($score);	
						$dureeEcoule = $request->get('timeLeft');
						$timeline->setEvent($dureeDuMatch."' 1 point for ".$teamA->getTeam());
						$timeline->setTime($dureeDuMatch);
						$timeline->setMatch($match);
						$em->persist($timeline);
					}
					if($request->get('btn')=='more2'){
						$score2 = $update->getScore2();
						$score2 += 1;
						$update->setScore2($score2);
						$dureeEcoule = $request->get('timeLeft');
						$timeline->setEvent($dureeDuMatch."' 1 point for ".$teamB->getTeam());
						$timeline->setTime($dureeDuMatch);
						$timeline->setMatch($match);
						$em->persist($timeline);

					}

					if($request->get('btn')=='less1'){
						$score3 = $update->getScore1();
						$score3 -= 1;
						$update->setScore1($score3);
						$dureeEcoule = $request->get('timeLeft');
						$timeline->setEvent($dureeDuMatch."' 1 point removed for ".$teamA->getTeam());
						$timeline->setTime($dureeDuMatch);
						$timeline->setMatch($match);
						$em->persist($timeline);	
					}
					if($request->get('btn')=='less2'){
						$score4 = $update->getScore2();
						$score4 -= 1;
						$update->setScore2($score4);
						$dureeEcoule = $request->get('timeLeft');
						$timeline->setEvent($dureeDuMatch."' 1 point removed for ".$teamB->getTeam());
						$timeline->setTime($dureeDuMatch);
						$timeline->setMatch($match);
						$em->persist($timeline);	
					}

				}

					

				if($request->get('btn')=='btnPlay'){
					if(!($update->getEtat()))
					{
						$update->setHeureDepart($now);
						$update->setEtat(true);
						$timeline->setEvent($dureeDuMatch."' Game ");
						$timeline->setTime($dureeDuMatch);
						$timeline->setMatch($match);
						$em->persist($timeline);
					}
					else
					{				
						$update->setEtat(false);
						$duree = $update->getDuree();
						$dureeEcoule = $request->get('timeLeft');
						$update->setDuree($dureeEcoule);
						$timeline->setEvent($dureeDuMatch."' Timeout ");
						$timeline->setTime($dureeDuMatch);
						$timeline->setMatch($match);
						$em->persist($timeline);	
					}	
				}

				if($request->get('btn')=='btnInit'){
					
					$update->setDuree($request->get('duree')*60);
					$update->setDureeMatch($update->getDureeMatch() + $request->get('duree')*60);
					$timeline->setEvent($dureeDuMatch."' Match begining ");
					$timeline->setTime("0");
					$timeline->setMatch($match);
					$em->persist($timeline);

				}
				if($request->get('btn')=='temps'){
					$update->setEtat(false);

				}
				if($request->get('btn')=='end'){
					$update->setFinDuMatch(true);
					$timeline->setEvent($dureeDuMatch."' Match ending ");
				}
			
				$em->flush();


			}
		}

		

		
		

		if ($request->isXmlHttpRequest()) {
			// JSON Response ;
			return new JsonResponse($match->toArray());
		} else {
			return $this->render('ScoreBoardBundle:Default:match.html.twig', array(		
			'match' => $match,'timelines' => $time));
		}
	
}

	public function contactAction()
	{
		$content = $this->get('templating')->render('ScoreBoardBundle:Default:contact.html.twig');
		return new Response($content);
	}

	public function createAction()
	{
	$em = $this->getDoctrine()->getEntityManager();
	$now = new \DateTime;

    $m = new Matchs();
	$form = $this->createForm(new MatchsType);

	$request = $this->getRequest();
	if ($request->isMethod('POST')){
		$form->handleRequest($request);
		$m = $form->getData();
		$m->setScore1(0);
		$m->setScore2(0);
		$m->setDuree(0);
		$m->setDureeMatch(0);
		$m->setHeureDepart($now);
		$m->setEtat(false);
		$m->setFinDuMatch(false);
		$em->persist($m);
		$em->flush();

		return $this->redirect("match/".$m->getID());
	}
		return $this->render('ScoreBoardBundle:Default:create.html.twig', array(
			'form' => $form->createView()));
	}

	public function teamAction()
	{
	$em = $this->getDoctrine()->getEntityManager();
	$t = new Team();
	$form = $this->createForm(new TeamType);

	$request = $this->getRequest();
	if ($request->isMethod('POST')){
		$form->handleRequest($request);
		$t = $form->getData();
		$em->persist($t);
		$em->flush();

		return $this->redirect("team");
	}
		return $this->render('ScoreBoardBundle:Default:team.html.twig', array(
			'form' => $form->createView()));
	}

	public function createtournamentAction()
	{

	$em = $this->getDoctrine()->getEntityManager();
	$t = new Tournament();
	$form = $this->createForm(new TournamentType);

	$request = $this->getRequest();
	if ($request->isMethod('POST')){

		$form->handleRequest($request);
		$t = $form->getData();
		$em->persist($t);
		$em->flush();

		return $this->redirect("tournament/".$t->getID());
	}
		return $this->render('ScoreBoardBundle:Default:createtournament.html.twig', array(
			'form' => $form->createView()));	
	}

	public function tournamentAction(Tournament $t)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$matchs = $em->getRepository("ScoreBoardBundle:Matchs")->findBy(array('tournament' => $t->getId()));
		$team = $em->getRepository("ScoreBoardBundle:Team")->findAll();

		$request = $this->getRequest();




		return $this->render('ScoreBoardBundle:Default:tournament.html.twig', array(
		'matchs' => $matchs, 'team' => $team));
	}
}


