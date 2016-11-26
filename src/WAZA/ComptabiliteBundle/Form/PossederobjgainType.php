<?php

namespace WAZA\ComptabiliteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PossederobjgainType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('responsable', TextType::class)
            ->add('quantite', NumberType::class)
            ->add('Objet', EntityType::class, array(
                    'class'        => 'WAZAComptabiliteBundle:Objet',
                    'choice_label' => 'nom',
                    'multiple'     => false,))
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
            'data_class' => 'WAZA\ComptabiliteBundle\Entity\Possederobjgain'
        ));
    }
}
