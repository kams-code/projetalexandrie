<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategorieType extends ContentType
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
            ->add('image', 'text', array('required' => false))
            ->add('parent','entity', array(
											'class' => 'EricoApiBundle:Categorie',
											'multiple'=>false,
											'property'=>'chemin',
											'query_builder'=>function(\Erico\ApiBundle\Entity\CategorieRepository $r) use($options){
												$query = $r->createQueryBuilder('c')
												->select('c')
												->where('c <> :idc')
												->andwhere('c.archiver = false')
												->setParameter('idc', $options['idcat'])
												->orderBy('c.designation','ASC');
												return $query;
											},
											'label'=>'categorie parente : ',
											'placeholder' => 'Selectionner une catégorie',
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
            'data_class' => 'Erico\ApiBundle\Entity\Categorie',
			'idcat' => null,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_categorie';
    }
}
