<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Product;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder

        ->add( 'title', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '50'
            ],
            'label' => 'Titre',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Length( [ 'min' => 2, 'max' => 50 ] ),
                new Assert\NotBlank()
            ]
        ] )

        ->add( 'brand', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '50'
            ],
            'label' => 'Marque',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Length( [ 'min' => 2, 'max' => 50 ] ),
                new Assert\NotBlank()
            ]
        ] )

        ->add( 'price', MoneyType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'required' => false,
            'label' => 'Prix ',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan( 1001 )
            ]
        ] )

        ->add( 'description', TextareaType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 5
            ],
            'label' => 'Description',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank()
            ]
        ] )

        ->add( 'categoryShop', EntityType::class, [
            'label'  => 'Category',
            'placeholder' => 'Auteur',
                    
    
            // looks for choices from this entity
            'class' => Category::class,
        
            // Sur quelle propriete je fais le choix
            'choice_label' => 'title',
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            //'expanded' => true,
        ])
        
        ->add( 'imageShop', FileType::class, [
            'label' => 'Images',
            'multiple' => true,
            'mapped' => false
        ] )

        ->add( 'submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4'
            ],
            'label' => 'Valider mon choix'
        ] );
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => Product::class,
        ] );
    }
}
