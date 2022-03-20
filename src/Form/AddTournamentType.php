<?php

namespace App\Form;

use App\Entity\AgeCategory;
use App\Entity\Gender;
use App\Entity\Tournament;
use App\Entity\TypeCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddTournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('city', TextType::class, [
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('classed', CheckboxType::class,[
                'label_attr' => ['class' => 'form-label'],
                'attr' =>  [ 'class' => 'form-check']
            ])
            ->add('eloMin', IntegerType::class, [
                'label_attr' => ['class' => 'form-label'],
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('eloMax', IntegerType::class, [
                'label_attr' => ['class' => 'form-label'],
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('ageCategory', EnumType::class, [
                'class' => AgeCategory::class,
//                'multiple' => true,
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-select']
            ])
            ->add('genderCategory', EnumType::class, [
                'class' => Gender::class,
//                'multiple' => true,
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-select']
            ])
            ->add('typeCategory', EnumType::class, [
                'class' => TypeCategory::class,
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-select']
            ])
            ->add('roundsNumber', IntegerType::class,[
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('minPlayers', IntegerType::class, [
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
            ->add('maxPlayers', IntegerType::class,[
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'attr' =>  [ 'class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
        ]);
    }
}
