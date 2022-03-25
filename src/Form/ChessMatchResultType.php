<?php

namespace App\Form;

use App\Entity\ChessMatch;
use App\Entity\Player;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChessMatchResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('round', HiddenType::class, [

            ])
            ->add('player1', EntityType::class, [
                'class' => Player::class
            ])
            ->add('player2', EntityType::class, [
                'class' => Player::class
            ])
            ->add('tournament', EntityType::class, [
                'class' => Tournament::class
            ])
            ->add('result')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ChessMatch::class,
        ]);
    }
}
