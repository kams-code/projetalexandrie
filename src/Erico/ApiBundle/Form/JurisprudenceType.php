<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JurisprudenceType extends LoiType
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
            ->add('nomTribunal')
            ->add('sectionTribunal')
			->add('description', 'textarea', array('required' => false))
			->add('nature', 'entity', array(
											'class' => 'EricoApiBundle:Nature',
											'multiple'=>false,
											'property'=>'designation',
											'label'=>'Nature : ',
											'placeholder' => 'Selectionner la nature de la décision',
											'required'=>true,
											'attr'=>array('class'=>''))
										  )
            ->add('decision_attaque', 'text', array('required' => false))
			->add('textes','entity', array(
											'class' => 'EricoApiBundle:Paragraphe',
											'multiple'=>true,
											'property'=>'designationTexte',
											'query_builder'=>function(\Erico\ApiBundle\Entity\ParagrapheRepository $r) use($options){
												$query = $r->createQueryBuilder('p')
												->select('p')
												->where('p.texte in (SELECT t FROM EricoApiBundle:TexteLoi t)')
												->andwhere('p.archiver = false')
												->andwhere('p.is_article = true')
												->orderBy('p.id','ASC');
												return $query;
											},
											'label'=>'Textes appliqués : ',
											'placeholder' => 'Selectionner les textes appliqués',
											'required'=>false,
											'attr'=>array('class'=>'select-multiple'))
										  )
			->add('sommaire', 'textarea', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Jurisprudence'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_jurisprudence';
    }
}
