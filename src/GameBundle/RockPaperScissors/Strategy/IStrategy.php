<?php
namespace GameBundle\RockPaperScissors\Strategy;

use GameBundle\RockPaperScissors\Card\ICard;

interface IStrategy
{
    public function makeDecision(): ICard;
}