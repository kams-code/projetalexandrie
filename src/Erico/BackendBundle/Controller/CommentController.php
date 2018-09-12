<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Commentaire;
use Erico\ApiBundle\Form\CommentaireType;
use Erico\ApiBundle\Form\CommentaireType2;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function indexAction()
    {
		
		$em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('EricoApiBundle:Commentaire')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		
		$comment_rep = new Commentaire;
		//user;
		if($this->getUser() != null && $this->getUser()->getUsername() != $this->getParameter('super_admin'))
		$comment_rep->setUser($this->getUser());
		
		$form = $this->createForm(new CommentaireType2, $comment_rep);
		$request = $this->get('request');
		
	    if($request->getMethod() == 'POST') {
		  
			$form->bind($request);
			
			if($form->isValid()) {
			  
			  if( $request->isXmlHttpRequest() ) //on si la requête est en AJAX
			  {
				 // On récupère notre paramètre parent
				$idparent = $request->query->get('parent');
				$parent = $em->getRepository('EricoApiBundle:Commentaire')->find($idparent);
				if($parent != null)
				{
					$comment_rep->setParent($parent);
					$comment_rep->setPublication($parent->getPublication());
				}	  
			 
				$em->persist($comment_rep);
				$em->flush();
				$response = new Response("ok");
				return $response;
			  }
			  
			}
		  
	    }
		
        return $this->render('EricoBackendBundle:Comment:index.html.twig', array('commentaires'=>$comments, 'form_comment' => $form->createView()));
    }
	
	public function updateAction($id)
    {
        
		$em = $this->getDoctrine()->getManager();
		$commentaire = $em->getRepository('EricoApiBundle:Commentaire')->find($id);
		
		$form = $this->createForm(new CommentaireType, $commentaire);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$commentaire->setDateModif(new \DateTime());
		    $em->flush();
			return $this->redirect($this->generateUrl('erico_backend_comment_page'));
			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:Comment:form.html.twig', array('form_comment' => $form->createView()));

		
    }
	
	public function approveAction()
    {
		
		$em = $this->getDoctrine()->getManager();
		$request = $this->get('request');	  
		 // On récupère notre paramètre parent
		$idcomment = $request->query->get('comment');
		$approve = $request->query->get('approve');
		
		$comment = $em->getRepository('EricoApiBundle:Commentaire')->find($idcomment);
		
		if($comment != null)
		{
			$comment->setApprouver($approve);
			$em->flush();

		}	  
	 
		$response = new Response("ok");
		return $response;
			  
		
    }
	
	
}
