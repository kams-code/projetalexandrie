<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParagrapheType extends ContentType
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
		
			->add('is_article')
            ->add('description', 'textarea', array('required' => false))
           /*  ->add('texte','entity', array(
											'class' => 'EricoApiBundle:TexteLoi',
											'multiple'=>false,
											'property'=>'designation',
											'label'=>'texte',
											'placeholder' => 'Choisir le texte',
											'required'=>false,
											'attr'=>array('class'=>'select-multiple'))
										 ) */
            ->add('parent','entity', array( 'class' => 'EricoApiBundle:Paragraphe',
											'property'=>'designation',
											'query_builder'=>function(\Erico\ApiBundle\Entity\ParagrapheRepository $r) use($options){
												
												$query = $r->createQueryBuilder('p')
												->select('p')
												->where('p.texte = :idt')
												->andWhere('p <> :idp')
												->andWhere('p.archiver = false')
												->setParameter('idt', $options['idtexte'])
												->setParameter('idp', $options['idpara'])
												->orderBy('p.id','ASC');
												return $query;
												//return $r->getListeParaTexte($options['idtexte']);
											},
											'multiple'=>false,
											'label'=>'Grand Titre',
											'placeholder' => 'Selectionner un titre',
											'required'=>false,
											'attr'=>array('class'=>'select-multiple'),
											))
										
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Paragraphe',
			'idtexte' => null,
			'idpara' => null,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_paragraphe';
    }
}
