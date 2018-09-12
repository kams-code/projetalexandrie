<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\TexteLoi;
use Erico\ApiBundle\Form\TexteLoiType;

class TexteLoiController extends Controller
{
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
        $lois = $em->getRepository('EricoApiBundle:TexteLoi')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		
        return $this->render('EricoBackendBundle:Loi:index.html.twig', array('lois' => $lois));
    }
	
	public function addAction()
    {
		
		$loi = new TexteLoi;
	    $form = $this->createForm(new TexteLoiType, $loi);
	    
		$request = $this->get('request');
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			  
		    $em = $this->getDoctrine()->getManager();
		    $em->persist($loi);
		    $em->flush();
			
		    return $this->redirect($this->generateUrl('erico_backend_texteloi_page'));
			
		  }
		  
		  
	    }
		  
        return $this->render('EricoBackendBundle:Loi:form.html.twig', array('form_loi' => $form->createView()));
		
    }
	
	public function updateAction($id)
    {
		// recherche de l'entite
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('EricoApiBundle:TexteLoi');
		$loi = $repository->find($id);		
		
		$form = $this->createForm(new TexteLoiType, $loi);
		
		$request = $this->get('request');
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if ($form->isValid()) {
			$loi->setDateModif(new \DateTime());
		    $em->flush();
		    return $this->redirect($this->generateUrl('erico_backend_texteloi_page'));
		  }
		  
	    }
		
		
        return $this->render('EricoBackendBundle:Loi:form.html.twig', array('form_loi' => $form->createView()));
    }
	
	
	
}
