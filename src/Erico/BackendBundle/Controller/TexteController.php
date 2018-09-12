<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Paragraphe;
use Erico\ApiBundle\Form\ParagrapheType;
use Symfony\Component\HttpFoundation\Response;

class TexteController extends Controller
{
	
	
	public function indexAction($title_prev_link, $id)
    {
        
		$em = $this->getDoctrine()->getManager();
		
		$text = $em->getRepository('EricoApiBundle:Texte')->find($id);
		
		$tab = array();
		
		$page = "";
		
		$text->{'page'} = "";
		
		$Paragraphes = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('texte'=>$text->getId(), 'archiver'=>false), array('ordre' => 'ASC'));
		
		
		
		foreach($Paragraphes as $paragraphe){
			
			if($paragraphe->getParent() == null)
			{
				
				$tab_row = $this->createRow($paragraphe, $title_prev_link);
				

				$page .= $this->createParagraphe($paragraphe, 28, $title_prev_link);
				//$tab_row['tags'] = array('0');
				
				$fils_1 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$paragraphe->getId(), 'archiver'=>false), array('ordre' => 'ASC'));
				
				if($fils_1 != null)
				{
					foreach($fils_1 as $fil_1){
						
						$tab_row_fil_1 = $this->createRow($fil_1, $title_prev_link);
						
						$page .= $this->createParagraphe($fil_1, 20, $title_prev_link);
						//$tab_row_fil['tags'] = array('0');
						
						$fils_2 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_1->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

						if($fils_2 != null)
						{
							foreach($fils_2 as $fil_2){
								
								$tab_row_fil_2 = $this->createRow($fil_2, $title_prev_link);
								
								$page .= $this->createParagraphe($fil_2, 16, $title_prev_link);;
								
								$fils_3 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_2->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

								if($fils_3 != null)
								{
									foreach($fils_3 as $fil_3){
										
										$tab_row_fil_3 = $this->createRow($fil_3, $title_prev_link);
										
										$page .= $this->createParagraphe($fil_3, 16, $title_prev_link);
										
										$fils_4 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_3->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

										if($fils_4 != null)
										{
											foreach($fils_4 as $fil_4){
												$tab_row_fil_4 = $this->createRow($fil_4, $title_prev_link);
												
												$page .= $this->createParagraphe($fil_4, 16, $title_prev_link);
												
												$fils_5 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_4->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

												if($fils_5 != null)
												{
													foreach($fils_5 as $fil_5){
														
														$tab_row_fil_5 = $this->createRow($fil_5, $title_prev_link);
														
														$page .= $this->createParagraphe($fil_5, 16, $title_prev_link);
														
														$fils_6 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_5->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

														if($fils_6 != null)
														{
															foreach($fils_6 as $fil_6){
																
																$tab_row_fil_6 = $this->createRow($fil_6, $title_prev_link);
																
																$page .= $this->createParagraphe($fil_6, 16, $title_prev_link);
																
																$fils_7 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_6->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																if($fils_7 != null)
																{
																	foreach($fils_7 as $fil_7){
																		
																		$tab_row_fil_7 = $this->createRow($fil_7, $title_prev_link);
																		
																		$page .= $this->createParagraphe($fil_7, 16, $title_prev_link);
																		
																		$fils_8 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_7->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																		if($fils_8 != null)
																		{
																			foreach($fils_8 as $fil_8){
																				
																				$tab_row_fil_8 = $this->createRow($fil_8, $title_prev_link);
																				
																				$page .= $this->createParagraphe($fil_8, 16, $title_prev_link);
																				
																				$fils_9 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_8->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																				if($fils_9 != null)
																				{
																					foreach($fils_9 as $fil_9){
																						
																						$tab_row_fil_9 = $this->createRow($fil_9, $title_prev_link);
																						
																						$page .= $this->createParagraphe($fil_9, 16, $title_prev_link);
																						
																						$fils_10 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_9->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																						if($fils_10 != null)
																						{
																							foreach($fils_10 as $fil_10){
																								
																								$tab_row_fil_10 = $this->createRow($fil_10, $title_prev_link);
																								
																								$page .= $this->createParagraphe($fil_10, 16, $title_prev_link);																							
																								
																								$tab_row_fil_9['nodes'][] = $tab_row_fil_10;
																							
																							}
																						}
																				
																						$tab_row_fil_8['nodes'][] = $tab_row_fil_9;
																					
																					}
																				}
																				
																				$tab_row_fil_7['nodes'][] = $tab_row_fil_8;
																			
																			}
																		}
																
																		$tab_row_fil_6['nodes'][] = $tab_row_fil_7;
																	
																	}
																}
																
																$tab_row_fil_5['nodes'][] = $tab_row_fil_6;
															
															}
														}
														
														$tab_row_fil_4['nodes'][] = $tab_row_fil_5;
													
													}
												}
												
												$tab_row_fil_3['nodes'][] = $tab_row_fil_4;
											
											}
										}
										
										$tab_row_fil_2['nodes'][] = $tab_row_fil_3;
									
									}
								}
								
								$tab_row_fil_1['nodes'][] = $tab_row_fil_2;
							
							}
							
						}
						
						$tab_row['nodes'][] = $tab_row_fil_1;
					}
				}
				
				array_push($tab, $tab_row);
				
				$text->{'page'} = $page;
				
			}
			
		}
		
        $text->setJsonParagraphes(json_encode($tab));
		
		return $this->render('EricoBackendBundle:Texte:index.html.twig', array('texte'=>$text, 'title_prev_link'=>$title_prev_link));
		
    }
	
	public function addAction($title_prev_link, $id)
    {
		$para = new Paragraphe;
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('EricoApiBundle:Texte');
		$text = $repository->find($id);
		
		$para->setTexte($text);
		
	    $form = $this->createForm(new ParagrapheType, $para, array('idtexte'=>$para->getTexte()->getId(), 'idpara'=>0));
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    
		    $em->persist($para);
		    $em->flush();
			
		    return $this->redirect($this->generateUrl('erico_backend_texte_page', array('id'=>$id, 'title_prev_link'=>$title_prev_link)));
			
		  }
		  
	    }
		  
        return $this->render('EricoBackendBundle:Texte:form_para.html.twig', array('form_para' => $form->createView(),'texte'=>$para->getTexte(), 'title_prev_link'=>$title_prev_link));
		
    }
	
	public function updateAction($title_prev_link, $id, $paragraphe)
    {
		$em = $this->getDoctrine()->getManager();
		$para = $em->getRepository('EricoApiBundle:Paragraphe')->find($paragraphe);
		
		/* $repository = $em->getRepository('EricoApiBundle:TexteLoi');
		$text = $repository->find($id);
		
		$para->setTexte($text); */
		
	    $form = $this->createForm(new ParagrapheType, $para, array('idtexte'=>$para->getTexte()->getId(), 'idpara'=>$para->getId()));
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
		    
			$em->flush();
			
		    return $this->redirect($this->generateUrl('erico_backend_texte_page', array('id'=>$id, 'title_prev_link'=>$title_prev_link)));
			
		  }
		  
	    }
		  
        return $this->render('EricoBackendBundle:Texte:form_para.html.twig', array('form_para' => $form->createView(), 'texte'=>$para->getTexte(), 'title_prev_link'=>$title_prev_link));
    }
	
	public function brotherAction()
    {
        $em = $this->getDoctrine()->getManager();
		/*$tab['id'] = $cat->getId();
		$tab['designation'] = $cat->getDesignation();				
						
		$response = new Response(json_encode($tab));
		$response->headers->set('Content-Type', 'application/json');*/
		
		$request = $this->getRequest();
		
		$idparent = $request->query->get('idparent');
		$idtexte = $request->query->get('idtexte');
		
		if($idparent==0)
			$idparent = null;
		
		$paragraphes = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('texte'=>$idtexte, 'parent'=>$idparent, 'archiver'=>false), array('ordre' => 'ASC'));
		$tab = array();
		foreach($paragraphes as $elem){
			
			$tab_row['id'] = $elem->getId();
			$tab_row['designation'] = $elem->getDesignation();
			array_push($tab, $tab_row);
		}
		
		$response = new Response(json_encode($tab));
		$response->headers->set('Content-Type', 'application/json');
		return $response;
		/*$response = new Response($idparent);
		return $response;*/
    
	}
	
	public function saveOrderAction()
    {
		$em = $this->getDoctrine()->getManager();
		
		$request = $this->getRequest();
		
		$paragraphes = $tabref = explode(',',$request->query->get('paragraphes')); 
		
		$i = 0;
		
		foreach($paragraphes as $elem){
					
			$paragraphe = $em->getRepository('EricoApiBundle:Paragraphe')->find($elem);
			$paragraphe->setOrdre($i);
			$em->flush();
			$i++;
		}
		
		$response = new Response("ok");
		return $response;
	}
	
	public function createParagraphe($paragraphe , $size, $title_prev_link)
    {
		if($paragraphe->getParent() == null)
			$parent = 0;
		else
			$parent = $paragraphe->getParent()->getId();
		
		$response = '<h1 style="font-size:'.$size.'px; text-align:center" id="title'.$paragraphe->getId().'">'.$paragraphe->getDesignation().'<a  href="#" title="Supprimer" class="delete-content"  data-designation="'.$paragraphe->getDesignation().'" data-id="'.$paragraphe->getId().'">
																	<i class="glyphicon glyphicon-trash icon-white"></i>
															   </a>
															   <a class="" href="'.$this->generateUrl('erico_backend_updatetexte_page', array('id'=>$paragraphe->getTexte()->getId(), 'title_prev_link'=>$title_prev_link, 'paragraphe'=>$paragraphe->getId())).'" title="Éditer">
																	<i class="glyphicon glyphicon-edit icon-white"></i>
															   </a>
															   <a class="orderlink" data-parent="'.$parent.'" data-texte="'.$paragraphe->getTexte()->getId().'" href="#" title="Déplacer" >
																	<i class="glyphicon glyphicon-move"></i>
															   </a>
						  </h1><div>'.$paragraphe->getDescription().'</div>';
		return $response;
	}
	
	
	public function createRow($paragraphe, $title_prev_link)
    {
		if($paragraphe->getParent() == null)
			$parent = 0;
		else
			$parent = $paragraphe->getParent()->getId();
		
		$tab_row = array();
		$lienModifier = ' <a style="color:white" href="'.$this->generateUrl('erico_backend_updatetexte_page', array('id'=>$paragraphe->getTexte()->getId(), 'title_prev_link'=>$title_prev_link, 'paragraphe'=>$paragraphe->getId())).'" title="Éditer">
								<i class="glyphicon glyphicon-edit icon-white"></i>
						   </a>';
		$lienMove = '<a href="#" style="color:white"  class="orderlink" data-parent="'.$parent.'"  title="Déplacer" >
						<i class="glyphicon glyphicon-move"></i>
				     </a>';
		$lienDelete ='<a style="color:white" href="index.php"><i class="glyphicon glyphicon-trash icon-white" id="title58"></i></a>'; 			 
						   
		$tab_row['text'] = $paragraphe->getDesignation();
		$tab_row['href'] = "#title".$paragraphe->getId();
		//$tab_row['tags'] = array($lienDelete, $lienMove, $lienModifier);
		
		return  $tab_row;
		
	}
	
}