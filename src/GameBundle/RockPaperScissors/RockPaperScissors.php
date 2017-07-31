<?php

namespace GameBundle\RockPaperScissors;

use GameBundle\RockPaperScissors\Card\ICard;
use GameBundle\RockPaperScissors\Rule\IRuleResolver;
use GameBundle\RockPaperScissors\Strategy\IStrategy;

class RockPaperScissors
{
    /**
     * @var IStrategy
     */
    protected $strategy;
    /**
     * @var IRuleResolver
     */
    protected $resolver;

    /**
     * @var ICard|null
     */
    protected $opponentCard;

    /**
     * RockPaperScissors constructor.
     * @param IStrategy $strategy
     * @param IRuleResolver $resolver
     */
    public function __construct(IStrategy $strategy, IRuleResolver $resolver)
    {
        $this->strategy = $strategy;
        $this->resolver = $resolver;
    }

    /**
     * Get game result decision
     * @param ICard $inputCard
     * @return string
     */
    public function solve(ICard $inputCard): string
    {
        $this->computeOpponentCard();

        return $this->resolver->resolve($inputCard, $this->opponentCard);
    }

    protected function computeOpponentCard()
    {
        $this->opponentCard = $this->strategy->makeDecision();
    }

    /**
     * @return ICard|null
     */
    public function getOpponentCard()
    {
        return $this->opponentCard;
    }
}