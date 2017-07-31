<?php

namespace GameBundle\RockPaperScissors\Card;

class RockCard implements ICard
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'rock';
    }
}