<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserForm extends AbstractType
{
    public function buildForm(FormFormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Entrez votre e-mail'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                ],
            ])
            ->add('pseudo', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre pseudo'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'le pseudo doit contenir au moins 3 caractères',
                        'maxMessage' => 'le pseudo ne peut pas dépasser 50 caractère'
                    ])
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'attr' => ['placeholder' => 'Entrez votre mot de passe'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                    new Assert\Length(['min' => 6, 'minMessage' => 'le pseudo doit contenir au moins 6 caractères'])
                ],
                'first_options'  => array('label' => 'mot de passe'),
                'second_options' => array('label' => 'confirmation de mot de passe'),
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
