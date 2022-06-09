<?php

namespace App\Form;

use App\Dto\CommentaireDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array(
            'attr' => array(
                'class' => 'field--text'
            ),
            'label' => 'global.username'
        ))
            ->add('content', TextareaType::class, array(
                'attr' => array(
                    'class' => 'field--text-area'
                ),
                'label' => 'global.your_message'
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
            'data_class' => CommentaireDto::class
        ));
    }
}
