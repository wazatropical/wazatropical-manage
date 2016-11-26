<?php

namespace WAZA\ComptabiliteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('budget', NumberType::class)
            ->add('beneficev', NumberType::class, array('label'=> 'Benefice visé', 'required' => false))
            ->add('monnaie', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Monnaie',
                    'choice_label' => 'code',
                    'multiple'     => false,
                ))
            ->add('etat', CheckboxType::class, array('required' => false))
            ->add('datedebut', DateType::class, array('label'=> 'Date de début'))
            ->add('datefinv', DateType::class, array('label'=> 'Date de fin prévue', 'required' => false))
            ->add('description', TextareaType::class, array('required' => false))
            ->add('producteur', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Producteur',
                    'choice_label' => 'nom',
                    'multiple'     => false,
                    'required' => false,
                ))
            ->add('gain', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Gain',
                    'choice_label' => 'nom',
                    'multiple'     => false,
                    'required' => false,
                ))
            ->add('depense', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Depense',
                    'choice_label' => 'nom',
                    'multiple'     => false,
                    'required' => false,
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
            'data_class' => 'WAZA\ComptabiliteBundle\Entity\Production'
        ));
    }
}
