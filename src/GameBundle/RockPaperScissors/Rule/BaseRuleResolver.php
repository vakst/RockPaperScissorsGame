<?php

namespace GameBundle\RockPaperScissors\Rule;

use GameBundle\RockPaperScissors\Card\ICard;

abstract class BaseRuleResolver implements IRuleResolver
{
    const CARD_WON = 'won';
    const CARD_LOST = 'lost';
    const CARD_DRAW = 'draw';

    /**
     * @return array
     */
    protected abstract function getRuleMap(): array;

    /**
     * @param ICard $cardRight
     * @param ICard $cardLeft
     * @return string
     */
    public function resolve(ICard $cardRight, ICard $cardLeft): string
    {
        $rules = $this->getRuleMap();

        if (in_array(get_class($cardLeft), $rules[get_class($cardRight)], false)) {
            return self::CARD_WON;
        } else {
            if (in_array(get_class($cardRight), $rules[get_class($cardLeft)], false)) {
                return self::CARD_LOST;
            } else {
                return self::CARD_DRAW;
            }
        }
    }
}