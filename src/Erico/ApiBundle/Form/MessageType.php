<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends ContentType
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
			->add('name')
			->add('email', 'email', array('required'=>true))
            ->add('description')
        ;
		
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Message'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_message';
    }
}
