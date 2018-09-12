<?php

namespace Alexandrie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

use Spipu\Html2Pdf\Html2Pdf;

class SubcriptionController extends DefaultController
{
    
	public function TexteAction($id)
	{
		$request = $this->get('request');
		$search_parameter = array();
		$search_parameter['q'] = $request->query->get('q');
		$search_parameter['pub'] = $request->query->get('pub');
		$search_parameter['num'] = $request->query->get('num');
		$search_parameter['op'] = $request->query->get('op');
		$search_parameter['date1'] = $request->query->get('date1');
		$search_parameter['date2'] = $request->query->get('date2');
		$search_parameter['juridiction'] = $request->query->get('juridiction');
		$search_parameter['section'] = $request->query->get('section');
		$search_parameter['nature'] = $request->query->get('nature');
		
		$em = $this->getDoctrine()->getManager();
		$texte = $em->getRepository('EricoApiBundle:Texte')->find($id);
		
		$texte->{'type'} = "Publication";
			
		$jurisprudence = $em->getRepository('EricoApiBundle:Jurisprudence')->find($texte->getId());
		if($jurisprudence != null)
		{
			$texte = $jurisprudence;
			$next = $em->getRepository('EricoApiBundle:Jurisprudence')->getNext($jurisprudence->getId());
			$texte->{'next'} = $next;
			$previews = $em->getRepository('EricoApiBundle:Jurisprudence')->getPrevious($jurisprudence->getId());
			$texte->{'previews'} = $previews;
			$texte->{'type'} = "Jurisprudence";
		}
		
		$loi = $em->getRepository('EricoApiBundle:TexteLoi')->find($texte->getId());
		if($loi != null)
		{
			$texte = $loi;
			$next = $em->getRepository('EricoApiBundle:TexteLoi')->getNext($loi->getId());
			$texte->{'next'} = $next;
			$previews = $em->getRepository('EricoApiBundle:TexteLoi')->getPrevious($loi->getId());
			$texte->{'previews'} = $previews;
			$texte->{'type'} = "Texte de Loi";
		}
		
		$doc = $em->getRepository('EricoApiBundle:Document')->find($texte->getId());
		if($doc != null)
		{
			$texte = $doc;
			$next = $em->getRepository('EricoApiBundle:Document')->getNext($doc->getId());
			$texte->{'next'} = $next;
			$previews = $em->getRepository('EricoApiBundle:Document')->getPrevious($doc->getId());
			$texte->{'previews'} = $previews;
			$texte->{'type'} = "Documentation";
		}
		
		$texte->{'page'} = "";
		
		$tab = array();
		
		$page = "";
		
		$Paragraphes = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('texte'=>$texte->getId(), 'archiver'=>false), array('ordre' => 'ASC'));
		
		if ($texte->{'type'}== "Jurisprudence")
		{
			/*$tab_row = array();
			$tab_row['text'] = "Sommaire";
			$tab_row['href'] = "#title0";
			array_push($tab, $tab_row);*/
			$page .='<div class="contributor-info">
				
						<h6>Sommaire</h6>
						<div class="sep1"></div>
						<div class="space10"></div>
						<p>'.$texte->getSommaire().'</p>
						<div class="space30"></div>
						<div class="sep1"></div>
						<div class="space20"></div>
						
					</div><br/>';
					
			//$page .= '<h1 style="font-size:20px; text-align:center" id="title0" >Sommaire</h1><div>'.$texte->getSommaire().'</div><br/><br/>';
			$page .= $texte->getDescription();
			
			//jurisprudence associé
			
			
			
			$result = $this->jurisprudenceCat($texte->getCategories()[0], $em);
			$voiraussi = array();
			foreach($result as $key=>$elem){
				
				if($key <= 20 and $elem->getId()!= $texte->getId())
				{
					$voiraussi[] = $elem;
				}
			}
			
			$texte->{'voiraussi'} = $voiraussi;
			
		}
		
		
		foreach($Paragraphes as $paragraphe){
			
			if($paragraphe->getParent() == null)
			{
				
				$tab_row = $this->createRow($paragraphe);
				

				$page .= $this->createParagraphe($paragraphe, 20);
				
				$fils_1 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$paragraphe->getId(), 'archiver'=>false), array('ordre' => 'ASC'));
				
				if($fils_1 != null)
				{
					foreach($fils_1 as $fil_1){
						
						$tab_row_fil_1 = $this->createRow($fil_1);
						
						$page .= $this->createParagraphe($fil_1, 16);
						
						$fils_2 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_1->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

						if($fils_2 != null)
						{
							foreach($fils_2 as $fil_2){
								
								$tab_row_fil_2 = $this->createRow($fil_2);
								
								$page .= $this->createParagraphe($fil_2, 16);;
								
								$fils_3 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_2->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

								if($fils_3 != null)
								{
									foreach($fils_3 as $fil_3){
										
										$tab_row_fil_3 = $this->createRow($fil_3);
										
										$page .= $this->createParagraphe($fil_3, 16);
										
										$fils_4 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_3->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

										if($fils_4 != null)
										{
											foreach($fils_4 as $fil_4){
												
												$tab_row_fil_4 = $this->createRow($fil_4);
												
												$page .= $this->createParagraphe($fil_4, 16);
												
												$fils_5 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_4->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

												if($fils_5 != null)
												{
													foreach($fils_5 as $fil_5){
														
														$tab_row_fil_5 = $this->createRow($fil_5);
														
														$page .= $this->createParagraphe($fil_5, 16);
														
														$fils_6 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_5->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

														if($fils_6 != null)
														{
															foreach($fils_6 as $fil_6){
																
																$tab_row_fil_6 = $this->createRow($fil_6);
																
																$page .= $this->createParagraphe($fil_6, 16);
																
																$fils_7 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_6->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																if($fils_7 != null)
																{
																	foreach($fils_7 as $fil_7){
																		
																		$tab_row_fil_7 = $this->createRow($fil_7);
																		
																		$page .= $this->createParagraphe($fil_7, 16);
																		
																		$fils_8 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_7->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																		if($fils_8 != null)
																		{
																			foreach($fils_8 as $fil_8){
																				
																				$tab_row_fil_8 = $this->createRow($fil_8);
																				
																				$page .= $this->createParagraphe($fil_8, 16);
																				
																				$fils_9 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_8->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																				if($fils_9 != null)
																				{
																					foreach($fils_9 as $fil_9){
																						
																						$tab_row_fil_9 = $this->createRow($fil_9);
																						
																						$page .= $this->createParagraphe($fil_9, 16);
																						
																						$fils_10 = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('parent'=>$fil_9->getId(), 'archiver'=>false), array('ordre' => 'ASC'));

																						if($fils_10 != null)
																						{
																							foreach($fils_10 as $fil_10){
																								
																								$tab_row_fil_10 = $this->createRow($fil_10);
																								
																								$page .= $this->createParagraphe($fil_10, 16);
																								
																								
																								
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
				
			}
			
		}
		
		
		$texte->{'jsonParagraphes'} = json_encode($tab);
		
		$texte->{'page'} = $page;
		
		$texte->setNbrVue($texte->getNbrVue() + 1);
		$em->flush();
		
        return $this->render('AlexandrieFrontendBundle:Texte:texte.html.twig', array('texte'=>$texte, 'search_parameter'=>$search_parameter));
	}
	
	public function createParagraphe($paragraphe , $size)
    {
		if($paragraphe->getParent() == null)
			$parent = 0;
		else
			$parent = $paragraphe->getParent()->getId();
		
		$response = '<h1 style="font-size:'.$size.'px; text-align:center;  color:#2e3192; padding:5px; font-weight:bold" id="title'.$paragraphe->getId().'" >'.$paragraphe->getDesignation().'</h1><div>'.$paragraphe->getDescription().'</div>';
		return $response;
	}
	
	public function createRow($paragraphe)
    {
		if($paragraphe->getParent() == null)
			$parent = 0;
		else
			$parent = $paragraphe->getParent()->getId();
		
		$tab_row = array();
		/*$lienModifier = ' <a style="color:white" href="'.$this->generateUrl('erico_backend_updatetexte_page', array('id'=>$paragraphe->getTexte()->getId(), 'title_prev_link'=>$title_prev_link, 'paragraphe'=>$paragraphe->getId())).'" title="Éditer">
								<i class="glyphicon glyphicon-edit icon-white"></i>
						   </a>';
		$lienMove = '<a href="#" style="color:white"  class="orderlink" data-parent="'.$parent.'"  title="Déplacer" >
						<i class="glyphicon glyphicon-move"></i>
				     </a>';
		$lienDelete ='<a style="color:white" href="index.php"><i class="glyphicon glyphicon-trash icon-white" id="title58"></i></a>'; 			 
			*/			   
		$tab_row['text'] = '<span style="font-family: Playfair Display, Helvetica Neue, Helvetica, Arial, sans-serif;">'.$paragraphe->getDesignation().'</span>';
		$tab_row['href'] = "#title".$paragraphe->getId();
		//$tab_row['tags'] = array($lienDelete, $lienMove, $lienModifier);
		
		return  $tab_row;
		
	}
	
	
	
	public function linkPage($i, $numpage, $text, $idcat, $nomcat)
	{
		$Page = '';
		if ($numpage == $i)
		$Page.='<li class="active"><a href="#">'.$text.'</a></li>';
		else 
		$Page.='<li><a href="'.$this->generateUrl('legiafrica_frontend_alltextepage', array('numpage'=>$i, 'idcat'=>$idcat, 'nomcat'=>$nomcat)).'">'.$text.'</a></li>';
		
		return $Page;
	}
	
	public function pagination5Link($nbrPage, $numpage, $idcat, $nomcat)
	{
		
		$Pages = '';
		
		if ($nbrPage <= 4)
		{
			for($i=1; $i <= $nbrPage; $i++)
			{
				
				$Pages .= $this->linkPage($i, $numpage, $i, $idcat, $nomcat);
				
			}
		}
		else
		{
			
			if($numpage>1)
			{
				$Pages.=$this->linkPage(1, $numpage, '<i class="fa fa-angle-double-left"></i>', $idcat, $nomcat); 
				$Pages.=$this->linkPage($numpage-1, $numpage, '<i class="fa fa-angle-left"></i>', $idcat, $nomcat); 
			}
			
			$Pages.= $this->linkPage($nbrPage, $nbrPage, $numpage.'/'.$nbrPage, $idcat, $nomcat);
			
			if($numpage < $nbrPage)
			{
				$Pages.=$this->linkPage($numpage+1, $numpage, '<i class="fa fa-angle-right"></i>', $idcat, $nomcat);
				$Pages.=$this->linkPage($nbrPage, $numpage, '<i class="fa fa-angle-double-right"></i>', $idcat, $nomcat);
			}
			
		}
		
		return $Pages;
		
	}
	
	
	public function texteCat($cat, $em)
	{
		$textes = array();
		$this->texteCatandFils($cat, $textes, $em);
		
		//elemination des doublons
		$newTextes = array();
		$temp = array();
		
		foreach($textes as $elemText){
			
			if(!(in_array($elemText->getId(), $temp))){
			
				$newTextes[] = $elemText;
				$temp[] = $elemText->getId();
				
			}
		
		}
		
		return $newTextes;
		
	}
	
	public function texteCatandFils($cat, &$textes, $em)
	{
		
		$pub = $em->getRepository('EricoApiBundle:Texte')->FindtextCat($cat->getId());
		
		foreach($pub as $elemText){
			
			$textes[] = $elemText;
		
		}
		
		if($cat->getFils() != null)
		{
			
			foreach($cat->getFils() as $elem){
			
				$this->texteCatandFils($elem, $textes, $em);
				
			}
			
		}
		
	}
	
	public function jurisprudenceCat($cat, $em)
	{
		$juriprudences = array();
		$this->jurisprudenceCatandFils($cat, $juriprudences, $em);
		
		//elemination des doublons
		$newTextes = array();
		$temp = array();
		
		foreach($juriprudences as $elemText){
			
			if(!(in_array($elemText->getId(), $temp))){
			
				$newTextes[] = $elemText;
				$temp[] = $elemText->getId();
				
			}
		
		}
		
		return $newTextes;
		
	}
	
	public function jurisprudenceCatandFils($cat, &$jurisprudences, $em)
	{
		
		$pub = $em->getRepository('EricoApiBundle:Jurisprudence')->FindjurisprudenceCat($cat->getId());
		
		foreach($pub as $elemText){
			
			$jurisprudences[] = $elemText;
		
		}
		
		if($cat->getFils() != null)
		{
			
			foreach($cat->getFils() as $elem){
			
				$this->jurisprudenceCatandFils($elem, $jurisprudences, $em);
				
			}
			
		}
		
	}

	public function treeviewCat($cat, $em)
	{
		
		$tab = array();
		
		if($cat == null)
		{
			$cats = array();
			$results = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('archiver'=>false), array('designation' => 'ASC'));
			
			foreach($results as $elem){
				{
					if($elem->getParent() == null)
					{
						$cats[] = $elem;
					}
					
				}
				
			}
			
		}
		else
		{
			$cats[] = $cat;
		}
		
		
		
		foreach($cats as $elem){
			
			
				$tab_row = $this->createRow2($elem, $em);
				
				$fils_1 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$elem->getId(), 'archiver'=>false), array('id' => 'ASC'));
				
				if($fils_1 != null)
				{
					foreach($fils_1 as $fil_1){
						
						$tab_row_fil_1 = $this->createRow2($fil_1, $em);
						
						
						$fils_2 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_1->getId(), 'archiver'=>false), array('id' => 'ASC'));

						if($fils_2 != null)
						{
							foreach($fils_2 as $fil_2){
								
								$tab_row_fil_2 = $this->createRow2($fil_2, $em);
								
								
								$fils_3 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_2->getId(), 'archiver'=>false), array('id' => 'ASC'));

								if($fils_3 != null)
								{
									foreach($fils_3 as $fil_3){
										
										$tab_row_fil_3 = $this->createRow2($fil_3, $em);
										
										
										$fils_4 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_3->getId(), 'archiver'=>false), array('id' => 'ASC'));

										if($fils_4 != null)
										{
											foreach($fils_4 as $fil_4){
												
												$tab_row_fil_4 = $this->createRow2($fil_4, $em);
												
												
												$fils_5 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_4->getId(), 'archiver'=>false), array('id' => 'ASC'));

												if($fils_5 != null)
												{
													foreach($fils_5 as $fil_5){
														
														$tab_row_fil_5 = $this->createRow2($fil_5, $em);
																												
														$fils_6 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_5->getId(), 'archiver'=>false), array('id' => 'ASC'));

														if($fils_6 != null)
														{
															foreach($fils_6 as $fil_6){
																
																$tab_row_fil_6 = $this->createRow2($fil_6, $em);
																																
																$fils_7 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_6->getId(), 'archiver'=>false), array('id' => 'ASC'));

																if($fils_7 != null)
																{
																	foreach($fils_7 as $fil_7){
																		
																		$tab_row_fil_7 = $this->createRow2($fil_7, $em);
																																				
																		$fils_8 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_7->getId(), 'archiver'=>false), array('id' => 'ASC'));

																		if($fils_8 != null)
																		{
																			foreach($fils_8 as $fil_8){
																				
																				$tab_row_fil_8 = $this->createRow2($fil_8, $em);
																																								
																				$fils_9 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_8->getId(), 'archiver'=>false), array('id' => 'ASC'));

																				if($fils_9 != null)
																				{
																					foreach($fils_9 as $fil_9){
																						
																						$tab_row_fil_9 = $this->createRow2($fil_9, $em);
																																												
																						$fils_10 = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('parent'=>$fil_9->getId(), 'archiver'=>false), array('id' => 'ASC'));

																						if($fils_10 != null)
																						{
																							foreach($fils_10 as $fil_10){
																								
																								$tab_row_fil_10 = $this->createRow2($fil_10, $em);
																																																
																								
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
				
			
			
			
			
		}
		
		return json_encode($tab);

		
	}
	
	public function createRow2($cat, $em)
    {
		
		$tab_row = array();
		/*$lienModifier = ' <a style="color:white" href="'.$this->generateUrl('erico_backend_updatetexte_page', array('id'=>$cat->getTexte()->getId(), 'title_prev_link'=>$title_prev_link, 'paragraphe'=>$cat->getId())).'" title="Éditer">
								<i class="glyphicon glyphicon-edit icon-white"></i>
						   </a>';
		$lienDelete ='<a style="color:white" href="index.php"><i class="glyphicon glyphicon-trash icon-white" id="title58"></i></a>'; 			 
			*/
		$titre = $cat->TitreRewrite();
		$link = $this->generateUrl('legiafrica_frontend_alltextepage', array('numpage'=>1, 'idcat'=>$cat->getId(), 'nomcat'=>$titre));
				
		$tab_row['text'] = '<span style="font-family: Playfair Display, Helvetica Neue, Helvetica, Arial, sans-serif;">'.ucfirst($cat->getDesignation()).'</span>';
		$tab_row['href'] = $link;
		$textes = $em->getRepository('EricoApiBundle:Texte')->FindTextCat($cat->getId());
		$tab_row['tags'] = array(count($textes));
		
		return  $tab_row;
		
	}	
	
	
	
	
	
}
