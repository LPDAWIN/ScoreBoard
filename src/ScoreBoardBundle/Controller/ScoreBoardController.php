<?php

namespace ScoreBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ScoreBoardBundle\Entity\Timeline;
use ScoreBoardBundle\Entity\Matchs;
use ScoreBoardBundle\Form\MatchsType;
use ScoreBoardBundle\Form\TeamType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class ScoreBoardController extends Controller
{

	public function homeAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$matchs = $em->getRepository("ScoreBoardBundle:Matchs")->findAll();

		return $this->render('ScoreBoardBundle:Default:home.html.twig', array(
			'matchs'  => $matchs));
	}

	public function matchAction(Matchs $match)
	{

		$request = $this->getRequest();
		$em = $this->getDoctrine()->getEntityManager();
		//$time =  $this->getDoctrine()->getManager()->getRepository("ScoreBoardBundle:Timeline")->timeLineTableau($match->getID());
		$time = $em->getRepository("ScoreBoardBundle:Timeline")->findBy(array('match' => $match->getID()));
		
		$now = new \DateTime;
		if($request->getMethod()=='POST'){
			$id = $request->get('id');

			
			$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => $id));
			
			$timeline = new Timeline();
			

			if($update->getDuree()!=0){
				if($request->get('btn')=='more1'){
					$score = $update->getScore1();
					$score += 1;
					$update->setScore1($score);	
				}
				if($request->get('btn')=='more2'){
					$score2 = $update->getScore2();
					$score2 += 1;
					$update->setScore2($score2);	
				}

				if($request->get('btn')=='less1'){
					$score3 = $update->getScore1();
					$score3 -= 1;
					$update->setScore1($score3);	
				}
				if($request->get('btn')=='less2'){
					$score4 = $update->getScore2();
					$score4 -= 1;
					$update->setScore2($score4);	
				}

			}

			if($request->get('btn')=='btnPlay'){
				if(!($update->getEtat()))
				{
					$update->setHeureDepart($now);
					$update->setEtat(true);
				}
				else
				{				
					$update->setEtat(false);
					$duree = $update->getDuree();
					$dureeEcoule = $request->get('timeLeft');
					$update->setDuree($dureeEcoule);	
				}	
			}

			if($request->get('btn')=='btnInit'){

				$id = $request->get('id');
				$newMatch = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id'=>$id));
				$update->setDuree($request->get('duree')*60);
				$timeline->setEvent("0 Début du match");
				$timeline->setTime("0");
				$timeline->setMatch($match);
				$em->persist($timeline);

			}
			if($request->get('btn')=='temps'){
				$update->setEtat(false);
			}
		
			$em->flush();

		}

		$match= $em->getRepository("ScoreBoardBundle:Matchs")->find($match->getID());

		
	

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
		$m->setHeureDepart($now);
		$m->setEtat(false);
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
}


