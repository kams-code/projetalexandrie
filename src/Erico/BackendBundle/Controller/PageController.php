<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Page;
use Erico\ApiBundle\Form\PageType;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function indexAction()
    {
		
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('EricoApiBundle:Page')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Page:index.html.twig', array('pages' => $pages));
		
    }
	
	public function addAction()
    {
        
		$page = new Page;
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new PageType, $page, array('idpage'=>0));
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    $em->persist($page);
		    $em->flush();
			
			return $this->redirect($this->generateUrl('erico_backend_page_page'));
			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:Page:form.html.twig', array('form_page' => $form->createView()));
    
	}
	
	public function updateAction($id)
    {
        
		$em = $this->getDoctrine()->getManager();
		$page = $em->getRepository('EricoApiBundle:Page')->find($id);
		
		$form = $this->createForm(new PageType, $page, array('idpage'=>$page->getId()));
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$page->setDateModif(new \DateTime());
		    $em->flush();
			return $this->redirect($this->generateUrl('erico_backend_page_page'));
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Page:form.html.twig', array('form_page' => $form->createView()));

    }
	
}