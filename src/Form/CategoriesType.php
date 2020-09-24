<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Etats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
           // ->add('users')
           ->add('etats', EntityType::class, [
            'class'=>'App\Entity\Etats',
            'choice_label'=>'lib_etat',
            'placeholder'=>'Choisir etat',
            // 'attr'=>['disabled'=>'disabled'],
            
        ])
           
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
