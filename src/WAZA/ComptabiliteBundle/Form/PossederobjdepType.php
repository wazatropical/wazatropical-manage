<?php

namespace WAZA\ComptabiliteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PossederobjdepType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('responsable')
            ->add('raison')
            ->add('quantite', NumberType::class)
            ->add('objet', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Objet',
                    'choice_label' => 'nom',
                    'multiple'     => false,
                ))
            ->add('date', DateType::class)
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WAZA\ComptabiliteBundle\Entity\Possederobjdep'
        ));
    }
}
