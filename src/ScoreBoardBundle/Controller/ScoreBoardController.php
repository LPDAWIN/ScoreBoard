<?php

namespace ScoreBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ScoreBoardBundle\Entity\Matchs;
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
			'matchs' => $matchs));
	}

	public function matchAction(Matchs $match)
	{
		$request = $this->getRequest();
		$em = $this->getDoctrine()->getEntityManager();
		$match = $em->getRepository("ScoreBoardBundle:Matchs")->createQueryBuilder('match')->getQuery()->getSingleResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
		

		if($request->getMethod()=='POST'){
			if($request->get('btn')=='more1'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => '2'));
				$score = $update->getScore1();
				$score += 1;
				$update->setScore1($score);
				$em->flush();
			}
			if($request->get('btn')=='more2'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => '2'));
				$score2 = $update->getScore2();
				$score2 += 1;
				$update->setScore2($score2);
				$em->flush();
			}

			if($request->get('btn')=='less1'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => '2'));
				$score3 = $update->getScore1();
				$score3 -= 1;
				$update->setScore1($score3);
				$em->flush();
			}
			if($request->get('btn')=='less2'){
				$update = $em->getRepository("ScoreBoardBundle:Matchs")->find(array('id' => '2'));
				$score4 = $update->getScore2();
				$score4 -= 1;
				$update->setScore2($score4);
				$em->flush();
			}
			
		}


=======
		//$match = $em->getRepository("ScoreBoardBundle:Matchs")->createQueryBuilder('match')->getQuery()->getSingleResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
		$match= $em->getRepository("ScoreBoardBundle:Matchs")->find($match->getID());
		
>>>>>>> 4c8e69ccad2d59eb30485996b1f81a2e6d6c714e
		if ($request->isXmlHttpRequest()) {
			// JSON Response 
			$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(new XmlEncoder(), new JsonEncoder()));
			$jsonContent = $serializer->serialize($match, 'json');
			return new Response($jsonContent);
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
}


