<?php

namespace GameBundle\RockPaperScissors\Strategy;

use GameBundle\RockPaperScissors\Card\CardType;
use GameBundle\RockPaperScissors\Card\ICard;

class RandomStrategy implements IStrategy
{
    /**
     * @return string
     */
    public function makeDecision(): ICard
    {
        $class = CardType::getList()[random_int(0, count(CardType::getList()) - 1)];

        return new $class;
    }
}