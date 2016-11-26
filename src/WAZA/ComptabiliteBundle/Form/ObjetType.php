<?php

namespace WAZA\ComptabiliteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ObjetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('pu', MoneyType::class)
            ->add('description', TextareaType::class, array('required' => false))
            ->add('monnaie', EntityType::class, array('class'=>'WAZAComptabiliteBundle:Monnaie',
                                                            'choice_label' => 'code',
                                                            'multiple'     => false,))
            ->add('mesure', EntityType::class, array('class'=>'WAZAComptabiliteBundle:Mesure',
                                                            'choice_label' => 'code',
                                                            'multiple'     => false,))
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WAZA\ComptabiliteBundle\Entity\Objet'
        ));
    }
}
