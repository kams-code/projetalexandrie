<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeclinaisonType extends ContentType
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
			//->add('produit')
		   ->add('attribut','entity', array(
											'class' => 'EricoApiBundle:Attribut',
											'multiple'=>false,
											'property'=>'Designation',
											'query_builder'=>function(\Erico\ApiBundle\Entity\AttributRepository $r){
												$query = $r->createQueryBuilder('a')
												->select('a')
												->where('a.archiver = false')
												->orderBy('a.designation','ASC');
												return $query;
											},
											'label'=>'Attribut: ',
											'placeholder' => 'Selectionner un attribut',
											'required'=>true)
										  )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Declinaison'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'erico_apibundle_declinaison';
    }
}
