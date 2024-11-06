<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ConnectForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
                'attr' => [
                    'placeholder' => 'Entrez votre e-mail'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe :',
                'attr' => [
                    'placeholder' => 'Entrez votre mot de passe'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide'])
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
