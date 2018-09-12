<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends PublicationType
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
			->add('fichier', 'text', array('required' => false))
            ->add('tarifRegulier', 'number', array('required' => false))
            //->add('unite')
			/* ->add('declinaisons', 'entity', array('class'=>'EricoApiBundle:Declinaison',
												'property'=>'nom',
												'query_builder'=>function(\Erico\ApiBundle\Entity\DeclinaisonRepository $r) use($options){
													$query = $r->createQueryBuilder('d')
													->select('d')
													->where('d.archiver = false')
													->orderBy('d.id','DESC');
													
													return $query;
												},
												'multiple'=>true,
												'placeholder'=>'Selectionner une déclinaison',
												'required'=>false,
												)) */
			/* ->add('normes', 'entity', array('class'=>'EricoApiBundle:Norme',
												'property'=>'designation',
												'query_builder'=>function(\Erico\ApiBundle\Entity\NormeRepository $r) {
													$query = $r->createQueryBuilder('n')
													->select('n')
													->where('n.archiver = false')
													->orderBy('n.designation','ASC');
													return $query;
												},
												'multiple'=>true,
												'placeholder'=>'Selectionner une norme',
												'required'=>false,
												)) */
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Produit',
			'idprod' => null,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'erico_apibundle_produit';
    }
}
