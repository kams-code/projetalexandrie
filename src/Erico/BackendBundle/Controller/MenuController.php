<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Menu;
use Erico\ApiBundle\Form\MenuType;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('EricoApiBundle:Menu')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		
        return $this->render('EricoBackendBundle:Menu:index.html.twig', array('menus'=>$menus));
    }
	
	public function addAction()
    {
        $menu = new Menu;
		
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new MenuType, $menu);
		
		$request = $this->get('request');
		
	    if($request->getMethod() == 'POST'){
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$em->persist($menu);
			
			
		    $em->flush();
			
			return $this->redirect($this->generateUrl('erico_backend_menu_page'));
			
		  }
		  
	    }
		
		return $this->render('EricoBackendBundle:Menu:form.html.twig', array('form_menu' => $form->createView()));
    }
	
	
	public function updateAction($id)
    {
        
		$em = $this->getDoctrine()->getManager();
		$menu = $em->getRepository('EricoApiBundle:Menu')->find($id);
		
		$form = $this->createForm(new MenuType, $menu);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			
			
		    $em->flush();
			
			return $this->redirect($this->generateUrl('erico_backend_menu_page'));
			
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Menu:form.html.twig', array('form_menu' => $form->createView()));

		
    }
	
	public function cibleAction()
    {
		$em = $this->getDoctrine()->getManager();
		$request = $this->get('request');
		$tab = array();
		
		$type = $request->query->get('type');
		
		$cibles = array();
		
		switch ($type) // on indique sur quelle variable on travaille
		{ 
		
			case "loi": 
				$cibles = $em->getRepository('EricoApiBundle:TexteLoi')->findBy(array('publier'=>true, 'archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "juris": 
				$cibles = $em->getRepository('EricoApiBundle:Jurisprudence')->findBy(array('publier'=>true, 'archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "doc": 
				$cibles = $em->getRepository('EricoApiBundle:Document')->findBy(array('publier'=>true, 'archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "actu": 
				$cibles = $em->getRepository('EricoApiBundle:Article')->findBy(array('publier'=>true, 'archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "cat": 
				$cibles = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "cat-actu": 
				$cibles = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "menu-actu": 
				$cibles = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('archiver'=>false), array('designation' => 'ASC'));
			break;

			case "prod": 
				$cibles = $em->getRepository('EricoApiBundle:Produit')->findBy(array('archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "cat-prod": 
				$cibles = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('archiver'=>false), array('designation' => 'ASC'));
			break;
			
			case "page": 
				$cibles = $em->getRepository('EricoApiBundle:Page')->findBy(array('publier'=>true, 'archiver'=>false), array('designation' => 'ASC'));
			break;
		}
		
		foreach($cibles as $elem)
		{
			$tab_row['id'] = $elem->getId();
			
			if($type == "cat" or $type == "cat-actu" or $type == "menu-actu" or $type == "cat-prod")
			{
				$tab_row['designation'] = $elem->getChemin();
			}
			else
			{
				$tab_row['designation'] = $elem->getDesignation();
			}
			
			array_push($tab, $tab_row);
		}
				
		$response = new Response(json_encode($tab));
		$response->headers->set('Content-Type', 'application/json');
		return $response;
		
	}
	
}
