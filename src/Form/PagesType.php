<?php

namespace App\Form;

use App\Entity\Pages;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

// use App\Entity\Categories;
// use App\Entity\Etats;

class PagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            //->add('slug')
            //->add('introduction',  CKEditorType::class)
            ->add('introduction')
            ->add('contenu', CKEditorType::class) //editeur wysiwig
            // ->add('images')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Images',
                'attr'=>['class'=>'custom-file-input','placeholder'=>'Choisir un fichier'],
               
            ])
            //->add('created_at')
            //->add('updated_at')
            //->add('users')

            ->add('categories', EntityType::class, [
                'class' => 'App\Entity\Categories',
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner la catégorie',
                // 'attr'=>['disabled'=>'disabled'],

            ])
            ->add('etats', EntityType::class, [
                'class' => 'App\Entity\Etats',
                'choice_label' => 'lib_etat',
                'placeholder' => 'Choisir etat',
                // 'attr'=>['disabled'=>'disabled'],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pages::class,
        ]);
    }
}
