<?php

namespace ScoreBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ScoreBoardBundle\Entity\Matchs;
use ScoreBoardBundle\Entity\Team;
use ScoreBoardBundle\Form\MatchsType;
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

		echo $request->get('duree');
		$now = new \DateTime;

		if($request->getMethod()=='POST'){
			$id = $request->get('id');

			if($request->get('btn')=='more1'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => $id));
				$score = $update->getScore1();
				$score += 1;
				$update->setScore1($score);
				$em->flush();
			}
			if($request->get('btn')=='more2'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => $id));
				$score2 = $update->getScore2();
				$score2 += 1;
				$update->setScore2($score2);
				$em->flush();
			}

			if($request->get('btn')=='less1'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => $id));
				$score3 = $update->getScore1();
				$score3 -= 1;
				$update->setScore1($score3);
				$em->flush();
			}
			if($request->get('btn')=='less2'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => $id));
				$score4 = $update->getScore2();
				$score4 -= 1;
				$update->setScore2($score4);
				$em->flush();
			}
			if($request->get('btn')=='play'){
				$id = $request->get('id');
				$newMatch = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id'=>$id));
				 $newMatch->setHeureDepart($now);
				 $em->flush();
			}
			if($request->get('btn')=='initi'){
				echo"qdsqnoqsdqsdqdsqdsdqsqdsqs";
				$id = $request->get('id');
				$newMatch = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id'=>$id));
				$newMatch->setDuree($request->get('duree'));
				$em->flush();
			}
	
		}

		//$match = $em->getRepository("ScoreBoardBundle:Matchs")->createQueryBuilder('match')->getQuery()->getSingleResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
		$match= $em->getRepository("ScoreBoardBundle:Matchs")->find($match->getID());

		
		//var_dump($now->getTimestamp()-$match->getHeureDepart()->getTimestamp()); exit(0);

		if ($request->isXmlHttpRequest()) {
			// JSON Response ;
			return new JsonResponse($match->toArray());
		} else {
			return $this->render('ScoreBoardBundle:Default:match.html.twig', array(		
			'match' => $match));
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
}


