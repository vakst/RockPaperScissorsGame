<?php

namespace GameBundle\RockPaperScissors\Rule;

use GameBundle\RockPaperScissors\Card\LizardCard;
use GameBundle\RockPaperScissors\Card\PaperCard;
use GameBundle\RockPaperScissors\Card\RockCard;
use GameBundle\RockPaperScissors\Card\ScissorsCard;
use GameBundle\RockPaperScissors\Card\SpockCard;

class StandardRuleResolver extends BaseRuleResolver
{
    /**
     * [a] - crushes/cuts/cover/.../ -> [b,c]
     * @var array
     */
    private $ruleMap = array(
        ScissorsCard::class => array(PaperCard::class, LizardCard::class),
        PaperCard::class => array(RockCard::class, SpockCard::class),
        RockCard::class => array(LizardCard::class, ScissorsCard::class),
        SpockCard::class => array(RockCard::class, ScissorsCard::class),
        LizardCard::class => array(SpockCard::class, PaperCard::class)
    );


    protected function getRuleMap(): array
    {
        return $this->ruleMap;
    }
}