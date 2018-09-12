<?php

namespace Alexandrie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EWZ\Bundle\SearchBundle\Lucene\LuceneSearch;

use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlexandrieFrontendBundle:Default:index.html.twig', array());
    }
	
	
	
	public function singleAction()
    {
        return $this->render('AlexandrieFrontendBundle:Default:single.html.twig', array());
    }
	
	public function keywordAction()
    {
		$keyword = array();
       
		$em = $this->getDoctrine()->getManager();
        $keys = $em->getRepository('EricoApiBundle:Keyword')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		
		foreach($keys as $elem){
			$row['name'] = $elem->getDesignation();
			$keyword[] = $row;
		}
		
		$response=new Response(json_encode($keyword));
		
		$response->headers->set('Content-Type', 'application/json');  
		return $response;
    }
	
	public function config()
    {
		
		$setting = new Setting;
		
		if ( file_exists($setting->file())) {
			
			$store = file_get_contents($setting->file());
			$setting = unserialize($store);
		}
		
		return $setting;
		
	}
	
	public function appconfig()
    {
		
		$setting = new AppSetting;
		
		if ( file_exists($setting->file())) {
			
			$store = file_get_contents($setting->file());
			$setting = unserialize($store);
		}
		
		return $setting;
		
	}
	
	
}
