<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PublicationType extends ContentType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // On fait appel à la méthode buildForm du parent, qui va ajouter tous les champs à $builder
		parent::buildForm($builder, $options);
		
		$builder
            //->add('description')
            //->add('imageIntro')
            //->add('nbrVue')
			->add('categories', 'entity', array('class'=>'EricoApiBundle:Categorie',
												'property'=>'chemin',
												'query_builder'=>function(\Erico\ApiBundle\Entity\CategorieRepository $r){
													$query = $r->createQueryBuilder('c')
													->select('c')
													->where('c.archiver = false')
													->orderBy('c.id','ASC');
													/*$tab = array();
													foreach($query as $elem){
														$tab[] = $elem;
													}*/
													return $query;
												},
												'multiple'=>true,
												'placeholder'=>'Selectionner une catégorie',
												'required'=>false,
												))
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Publication'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_publication';
    }
}
