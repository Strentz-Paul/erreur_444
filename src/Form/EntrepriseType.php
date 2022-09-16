<?php

namespace App\Form;

use App\Dto\EntrepriseDto;
use App\Enum\StatutJuridiqueEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array(
            'attr' => array(
                'class' => 'field--text'
            ),
            'label' => 'admin.compta.entreprise.name_label'
        ))
            ->add('dateDebut', DateType::class, array(
                'label' => 'admin.compta.entreprise.date_creation_label',
                'attr' => array(
                    'class' => 'field--text'
                ),
            ))
            ->add('statutJuridique', EnumType::class, array(
                'class' => StatutJuridiqueEnum::class,
                'label' => 'admin.compta.entreprise.statut_juridique_label',
                'attr' => array(
                    'class' => 'field--text'
                ),
            ))
            ->add('isExterne', ChoiceType::class, array(
                'choices' => array(
                    'Oui' => true,
                    'Non' => false
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'admin.compta.entreprise.create.is_external'
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
            'data_class' => EntrepriseDto::class
        ));
    }
}
