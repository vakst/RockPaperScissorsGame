<?php

namespace GameBundle\RockPaperScissors\Card;

class SpockCard implements ICard
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'spock';
    }
}