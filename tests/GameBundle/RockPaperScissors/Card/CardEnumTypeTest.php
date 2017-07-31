<?php

namespace Tests\GameBundle\RockPaperScissors\Card;

use PHPUnit\Framework\TestCase;
use GameBundle\RockPaperScissors\Card\CardType;
use GameBundle\RockPaperScissors\Card\ICard;
use GameBundle\RockPaperScissors\Card\LizardCard;
use GameBundle\RockPaperScissors\Card\PaperCard;
use GameBundle\RockPaperScissors\Card\RockCard;
use GameBundle\RockPaperScissors\Card\ScissorsCard;
use GameBundle\RockPaperScissors\Card\SpockCard;

class CardTypeTest extends TestCase
{
    public function testChoice()
    {
        $this->assertEquals(true, CardType::getCardByNameList('scissors') instanceof ScissorsCard);
        $this->assertEquals(true, CardType::getCardByNameList('lizard') instanceof LizardCard);
        $this->assertEquals(true, CardType::getCardByNameList('paper') instanceof PaperCard);
        $this->assertEquals(true, CardType::getCardByNameList('rock') instanceof RockCard);
        $this->assertEquals(true, CardType::getCardByNameList('spock') instanceof SpockCard);
        $this->assertEquals(false, CardType::getCardByNameList('lizard2') instanceof ICard);
    }
}