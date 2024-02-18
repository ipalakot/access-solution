<?php
namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UtilisateurType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('fullName', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50'
            ],
            'label' => 'Nom / Prénom',
            'label_attr' => [
                'class' => 'form-label  mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'min' => 2,
                    'max' => 50
                ])
            ]
        ])
            ->
        add('email')
            ->
        add('deliveryAddress')
            ->add('zipCode')
            ->add('city')
            ->add('phoneNumber');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class
        ]);
    }
}
