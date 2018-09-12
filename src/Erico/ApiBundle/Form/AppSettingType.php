<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AppSettingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('htmlheader', 'textarea', array('required' => false))
            ->add('htmlfooter', 'textarea', array('required' => false))
            ->add('piwik', 'textarea', array('required' => false))
            ->add('copyright', 'text', array('required' => false))
			->add('clientIDPaypal', 'textarea', array('required' => false))
			->add('secretPaypal', 'textarea', array('required' => false))
			->add('envPaypal', 'choice', array('choices' => array('sandbox' =>'Environnement de développement',  'production' => 'Environnement de production'), 'multiple'=>false))
			->add('javascriptPaypal', 'checkbox', array('required' => false))
		;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\AppSetting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'erico_apibundle_appsetting';
    }
}
