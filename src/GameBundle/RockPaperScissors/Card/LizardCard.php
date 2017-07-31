<?php

namespace GameBundle\RockPaperScissors\Card;

class LizardCard implements ICard
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'lizard';
    }
}