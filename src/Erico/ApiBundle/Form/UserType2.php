<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType2 extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('required'=>true))
            ->add('name', 'text', array('required'=>false))
            ->add('email', 'email', array('required'=>true))
			->add('plainPassword', 'password', array('required'=>false))
            //->add('password')
            //->add('salt')
            //->add('isActive')
            //->add('roles', 'choice', array('choices' => array('ROLE_USER' => 'Abonné',  'ROLE_ADMIN' => 'Administrateur'), 'multiple'=>true))
            //->add('dateCreation')
            //->add('lastConnection')
            ->add('newletter')
            ->add('tel')
            ->add('pays', 'country', array('placeholder'=>'Selectionner un votre pays d\'origine',))
			->add('ville')
            ->add('status', 'choice', array('choices' => array('particulier' => 'Particulier',  'entreprise' => 'Entreprise'), 'multiple'=>false))
            //->add('photo')
            ->add('adresse')
			->add('birdthday',  'date', array('widget' => 'single_text'))
			->add('profession')
			->add('fixephone')
			->add('civility', 'choice', array('choices' => array('0' => 'Mr',  '1' => 'Mme',  '2' => 'Mlle'), 'multiple'=>false))
			->add('sms')	
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'legiafrica_apibundle_user';
    }
}
