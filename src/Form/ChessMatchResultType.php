<?php

namespace App\Form;

use App\Entity\ChessMatch;
use App\Entity\Player;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChessMatchResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class, [

            ])
            ->add('result', ChoiceType::class, [
                'choices' => [
                        'P1' => 'player 1 id',
                        'X' => '',
                        'P2' => 'player 2 id'
                ],
                'attr' =>  [ 'class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
            ])
//            ->add('results', CollectionType::class,[
//                'entry_type' => ChessMatch::class,
//                'entry_options' => [
//                    'choices' => [
//                        'P1' => 'player 1 id',
//                        'X' => '',
//                        'P2' => 'player 2 id'
//                    ],
//                    'attr' =>  [ 'class' => 'form-control'],
//                    'label_attr' => ['class' => 'form-label'],
//                ]
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ChessMatch::class,
        ]);
    }
}
