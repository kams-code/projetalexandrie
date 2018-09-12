<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends PublicationType
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
			->add('description', 'textarea', array('required' => false))
			->add('imageIntro', 'hidden', array('required' => false))
			->add('categorie','entity', array(
											'class' => 'EricoApiBundle:Categorie',
											'multiple'=>false,
											'property'=>'chemin',
											'query_builder'=>function(\Erico\ApiBundle\Entity\CategorieRepository $r){
												$query = $r->createQueryBuilder('c')
												->select('c')
												->where('c.archiver = false')
												->orderBy('c.designation','ASC');
												return $query;
											},
											'label'=>'categorie par defaut: ',
											'placeholder' => 'Selectionner une catégorie',
											'required'=>true,
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
            'data_class' => 'Erico\ApiBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_article';
    }
}
