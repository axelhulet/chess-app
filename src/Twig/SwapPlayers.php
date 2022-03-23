<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SwapPlayers extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('swap_players', [$this, 'swapPlayers'])
        ];
    }

    public function swapPlayers($players)
    {
        $swap = array_pop($players);
        array_unshift($players, $swap);

        return $players;
    }
}