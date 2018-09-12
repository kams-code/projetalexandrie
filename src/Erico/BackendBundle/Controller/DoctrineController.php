<?php

namespace Erico\BackendBundle\Controller;

use Erico\ApiBundle\Entity\Doctrine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Erico\ApiBundle\Form\DoctrineType;
use Erico\ApiBundle\Entity\Paragraphe;
use erico\ApiBundle\Entity\Content;

class DoctrineController extends Controller
{
    public function indexAction(Request $request)
    {
        //creons l'objet Doctrine
        $doctrine = new Doctrine();
	    $form = $this->createForm(new DoctrineType, $doctrine);

        //creons le formBuilder grace au service form factory
        /*
        //ajoutons les champs de l'entite que l'on veut a notre formulaire
        $form = $this->get('form.factory')->createBuilder('form', $doctrine)
          ->add('nomAuteur', 'text')
          ->add('titreAuteur', 'text')
          ->add('specialite', 'text')
          ->add('bp', 'text')
          ->add('tel', 'text')
          ->add('email', 'text')
          ->add('datePublication', 'date')
          ->add('lieuDePublication', 'text')
          ->add('motCle', 'text')
          ->add('titreDocument', 'text')
          ->add('enregistrer', 'submit')
          ->getForm()
       ;

       // a partir du formBuilder, on genere le formulaire
       //$form = $formBuilder->getForm();
        
        
         $form->handleRequest($request);

       //on verifie si les valeurs d'entrees sont correctes
          if($form -> isValid()){
            // on enregistre notre object doctrine dans la base de donnees
           $em = $this->getDoctrine()->getManager();
           $em->persist($doctrine);
           $em->flush();

           $request->getSession()->getFlashBag()->add('notice', 'formulaire bien enregistre');
          */
          
         
          $request = $this->get('request');
          if ($request->getMethod() == 'POST') {
            
            $form->bind($request);
            
            if($form->isValid()) {
                
              $em = $this->getDoctrine()->getManager();
              $em->persist($doctrine);
              $em->flush();
              
           //on redirige vers la page d'ajout d'une doctrine
           return $this->redirect($this->generateUrl('erico_backend_adddoctrine_page', array('id' => 
           $doctrine->getId())));
          
            }
        }

       //on passe la methode createView() du formulaire a la vue
       //afin qu'elle puisse afficher le formulaire toute seule
      return $this->render('EricoBackendBundle:Doctrine:index.html.twig', array(
           'form' => $form->createView(),
       ));
    }


    public function addAction(Request $request)
    {
             //$id  = $request->get('id');

            $repository = $this->getDoctrine()->getManager()->getRepository('EricoApiBundle:Doctrine');  
            $doctrine = $repository->findAll(); 
            return $this->render('EricoBackendBundle:Doctrine:affiche.html.twig',array(
                'doctrine' => $doctrine));      
    }


    public function updateAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('EricoApiBundle:Doctrine');
        $doctrine = $repository->findAll();
        return $this->redirect($this->generateUrl('erico_backend_editdoctrine_page',
        array(
            'doctrine' => $doctrine)));
    }


    public function editAction(Request $request, Doctrine $doctrine)
    {
        /*
        $form = $this->get('form.factory')->createBuilder('form', $doctrine)
          ->add('nomAuteur', 'text')
          ->add('titreAuteur', 'text')
          ->add('specialite', 'text')
          ->add('bp', 'text')
          ->add('tel', 'text')
          ->add('email', 'text')
          ->add('datePublication', 'date')
          ->add('lieuDePublication', 'text')
          ->add('motCle', 'text')
          ->add('titreDocument', 'text')
          ->add('enregistrer', 'submit')
          ->getForm()
       ;

       // a partir du formBuilder, on genere le formulaire
       //$form = $formBuilder->getForm();
        
        
         $form->handleRequest($request);

       //on verifie si les valeurs d'entrees sont correctes
          if($form -> isValid()){
            // on enregistre notre object doctrine dans la base de donnees
           $em = $this->getDoctrine()->getManager();
           // pas important vu qu'on est deja dans la base de donnees
           //$em->persist($doctrine);
           $em->flush();

           $request->getSession()->getFlashBag()->add('notice', 'formulaire bien enregistre');
         */   
           
        $form = $this->createForm(new DoctrineType, $doctrine);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
          
          $form->bind($request);
          
          if($form->isValid()) {
              
            $em = $this->getDoctrine()->getManager();
            $em->persist($doctrine);
            $em->flush();
           

           //on redirige vers la page d'ajout d'une doctrine
           return $this->redirect($this->generateUrl('erico_backend_adddoctrine_page', array('id' => 
           $doctrine->getId())));

          }
        }

       //on passe la methode createView() du formulaire a la vue
       //afin qu'elle puisse afficher le formulaire toute seule
      return $this->render('EricoBackendBundle:Doctrine:index.html.twig', array(
           'form' => $form->createView(),
       ));
    }



    public function deleteAction(Doctrine $doctrine, Content $content)
    {
    
        /*$em = $this->getDoctrine()->getManager();
        $em->remove($doctrine);
        $em->flush(); */      
       
       $daina = $this->getDoctrine()->getManager();
       print_r($content);
       $daina->getRepository('EricoApiBundle:Content')->findBy(array('id'=>$content->getId()));
       $content->setArchiver(1);
       $daina->persist($content);
       $daina->flush();
              
    
        //return new Response('produit supprimer');
        return $this->redirect($this->generateUrl('erico_backend_adddoctrine_page'));
    }

   



    
  
}
