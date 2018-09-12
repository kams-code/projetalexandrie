<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends PublicationType
{


	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // On fait appel à la méthode buildForm du parent, qui va ajouter tous les champs à $builder
		//parent::buildForm($builder, $options);
		
		$builder
			->add('designation')
			->add('description', 'textarea', array('required' => false))
			->add('imageIntro', 'hidden', array('required' => false))
			->add('keywords', 'entity', array('class'=>'EricoApiBundle:Keyword',
												'property'=>'designation',
												'query_builder'=>function(\Erico\ApiBundle\Entity\keywordRepository $r){
													$query = $r->createQueryBuilder('k')
													->select('k')
													->where('k.archiver = false')
													->orderBy('k.designation','ASC');
													return $query;
												},
												'multiple'=>true,
												'placeholder' =>'Selectionner un mot clé',
												'required'=>false,
											  ))
			->add('datePublish', 'datetime', array('date_widget' => 'single_text', 'time_widget' => 'choice', 'placeholder' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour','hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde')))
            ->add('publier')
			->add('parent','entity', array(
											'class' => 'EricoApiBundle:Page',
											'multiple'=>false,
											'property'=>'Designation',
											'query_builder'=>function(\Erico\ApiBundle\Entity\PageRepository $r) use($options){
												$query = $r->createQueryBuilder('p')
												->select('p')
												->where('p <> :idp')
												->andwhere('p.archiver = false')
												->setParameter('idp', $options['idpage'])
												->orderBy('p.designation','ASC');
												return $query;
											},
											'label'=>'page parente : ',
											'placeholder' => 'Selectionner une page',
											'required'=>false,
											'attr'=>array('class'=>'select-multiple'))
										  )
		;	
    }
	
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Page',
			'idpage' => null,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_page';
    }
}
