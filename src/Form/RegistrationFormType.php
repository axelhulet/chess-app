<?php

namespace App\Form;

use App\Entity\Gender;
use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label_attr' => ['class' => 'form-label'],
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('firstName', TextType::class, [
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('birthDate', BirthdayType::class, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('gender', EnumType::class, [
                'class' => Gender::class,
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-select']
            ])
            ->add('picture', FileType::class, [
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
