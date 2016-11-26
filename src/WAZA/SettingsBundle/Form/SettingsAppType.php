<?php

namespace WAZA\SettingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsAppType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEntreprise')
            ->add('siteWebEntreprise')
            ->add('paysEntreprise')
            ->add('codePostalEntreprise')
            ->add('villeEntreprise')
            ->add('rueEntreprise')
            ->add('emailEntreprise')
            ->add('telEntreprise')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WAZA\SettingsBundle\Entity\SettingsApp'
        ));
    }
}
