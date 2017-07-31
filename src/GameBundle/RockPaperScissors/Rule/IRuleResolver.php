<?php

namespace GameBundle\RockPaperScissors\Rule;

use GameBundle\RockPaperScissors\Card\ICard;

interface IRuleResolver
{
    public function resolve(ICard $cardRight, ICard $cardLeft): string;
}
