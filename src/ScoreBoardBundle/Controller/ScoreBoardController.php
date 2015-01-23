<?php

namespace ScoreBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ScoreBoardBundle\Entity\Matchs;

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

		if ($request->isXmlHttpRequest()) {
			return new JsonResponse($match);
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