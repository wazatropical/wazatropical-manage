<?php

namespace WAZA\SettingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SettingsUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder                
            ->add('formatExpFile', EntityType::class, array(
                    'class'        => 'WAZAFileBundle:FormatExport',
                    'choice_label' => 'code',
                    'multiple'     => false,
                ))                
            ->add('monnaie1', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Monnaie',
                    'choice_label' => 'code',
                    'multiple'     => false,
                ))                
            ->add('monnaie2', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Monnaie',
                    'choice_label' => 'code',
                    'multiple'     => false,
                ))                
            ->add('monnaie3', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Monnaie',
                    'choice_label' => 'code',
                    'multiple'     => false,
                ))
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WAZA\SettingsBundle\Entity\SettingsUser'
        ));
    }
}
