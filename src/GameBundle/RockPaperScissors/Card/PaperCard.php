<?php

namespace GameBundle\RockPaperScissors\Card;

class PaperCard implements ICard
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'paper';
    }
}