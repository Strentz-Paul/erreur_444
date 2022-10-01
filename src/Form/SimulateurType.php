<?php

namespace App\Form;

use App\Dto\SimulateurDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimulateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tjm', IntegerType::class, array(
            'label' => 'admin.compta.simulateur.tjm',
            'attr' => array(
                'data-placeholder' => 'admin.compta.simulateur.placeholder.tjm'
            )
        ))
            ->add('nbJours', IntegerType::class, array(
                'label' => 'admin.compta.simulateur.number_day',
                'attr' => array(
                    'data-placeholder' => 'admin.compta.simulateur.placeholder.number_day'
                )
            ))
            ->add('tauxImpots', NumberType::class, array(
                'label' => 'admin.compta.simulateur.percent_impot',
                'attr' => array(
                    'data-placeholder' => 'admin.compta.simulateur.placeholder.percent_impot'
                )
            ))
            ->add('palierTVA', IntegerType::class, array(
                'label' => 'admin.compta.simulateur.step_tva',
                'attr' => array(
                    'data-placeholder' => 'admin.compta.simulateur.placeholder.step_tva'
                )
            ))
            ->add('tauxTVA', NumberType::class, array(
                'label' => 'admin.compta.simulateur.percent_tva',
                'attr' => array(
                    'data-placeholder' => 'admin.compta.simulateur.placeholder.percent_tva'
                )
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
            'data_class' => SimulateurDto::class
        ));
    }
}
