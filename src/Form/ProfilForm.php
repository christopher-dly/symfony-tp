<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\File as ConstraintsFile;

class ProfilForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('avatar', FileType::class, [
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new ConstraintsFile([
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/jpg',
                    ],
                    'mimeTypesMessage' => 'Merci d\'utiliser des images au format JPG ou JPEG'
                ])
            ]
            ])
            ->add('description', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre description'],
                'constraints' => [
                    new Assert\Length([
                        'max' => 500,
                        'maxMessage' => 'la description ne peut pas dépasser 500 caractère'
                    ])
                ],
            ])
            ->add('emploi', TextType::class, [
                'attr' => ['placeholder' => 'Entrer votre emploi actuel'],
                'constraints' => [
                    new Assert\Length([
                        'min' => 6,
                        'max' => 50,
                        'minMessage' => 'l\'emploi doit contenir au moins 6 caractères',
                        'maxMessage' => 'l\'emploi ne peut pas dépasser 50 caractère'
                    ])
                ]
            ])
            ->add('pseudo', TextType::class, [
                'attr' => ['placeholder' => 'Entrer votre nouveau pseudo'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Votre pseudo doit contenir au moins 3 caractères',
                        'maxMessage' => 'Votre pseudo ne peut pas dépasser 50 caractère'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
