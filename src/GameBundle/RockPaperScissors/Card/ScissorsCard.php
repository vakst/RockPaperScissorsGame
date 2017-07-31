<?php

namespace GameBundle\RockPaperScissors\Card;

class ScissorsCard implements ICard
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'scissors';
    }
}