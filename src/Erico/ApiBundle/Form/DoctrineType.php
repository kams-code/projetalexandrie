<?php

namespace Erico\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoctrineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAuteur')
            ->add('titreAuteur')
            ->add('specialite')
            ->add('bp')
            ->add('tel')
            ->add('email')
            ->add('datePublication')
            ->add('motCle')
            ->add('lieuDePublication')
            ->add('titreDocument')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Erico\ApiBundle\Entity\Doctrine'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'erico_apibundle_doctrine';
    }
}
