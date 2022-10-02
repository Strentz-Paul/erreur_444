<?php

namespace App\Form;

use App\Dto\DevisDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbJours', IntegerType::class, array(
            'attr' => array(
                'class' => 'field--text',
                'data-placeholder' => 'admin.compta.simulateur.placeholder.number_day'
            ),
            'label' => 'admin.compta.simulateur.number_day'
        ))
            ->add('tjm', NumberType::class, array(
                'attr' => array(
                    'class' => 'field--text-area',
                    'data-placeholder' => 'admin.compta.simulateur.placeholder.tjm'
                ),
                'label' => 'admin.compta.simulateur.tjm'
            ))
            ->add('statut', ChoiceType::class, array(
                'label' => 'admin.compta.simulateur.statut_devis',
                'attr' => array(
                    'class' => 'field--text'
                ),
                'choices' => array(
                    'Préparation' => 'Préparation',
                    'Envoyé' => 'Envoyé',
                    'Signé' => 'Signé',
                    'Refusé' => 'Refusé',
                    'Négociation' => 'Négociation'
                )
            ))
            ->add('completed', ChoiceType::class, array(
                'choices' => array(
                    'Oui' => true,
                    'Non' => false
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'admin.compta.devis.is_complete'
            ))
            ->add('submit', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn field--submit'
                ),
                'label' => 'global.submit'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DevisDto::class
        ));
    }
}
