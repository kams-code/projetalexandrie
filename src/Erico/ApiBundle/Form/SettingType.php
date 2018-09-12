<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class SettingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
		
        $builder
            ->add('titreSite')
			->add('logo', 'hidden', array('required' => false))
            ->add('tel')
			->add('googlemap', 'textarea', array('required' => false))
			//->add('icone')
			->add('cgu')
            ->add('email')
			->add('adresse')
			->add('facebook')
			->add('twitter')
			->add('youtube')
			->add('google')
			->add('linkedin')
			->add('viadeo')
			->add('aLaUne', 'hidden', array('required' => false))
			->add('mainmenu', 'hidden', array('required' => false))
			->add('secondarymenu', 'hidden', array('required' => false))
			->add('menu3', 'hidden', array('required' => false))
			->add('menu4', 'hidden', array('required' => false))
			->add('menu5', 'hidden', array('required' => false))
			->add('description', 'textarea', array('required' => false))
			->add('souscription', 'checkbox', array('required' => false))
			->add('connexionRequire', 'checkbox', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Setting',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_setting';
    }
	
	
}
