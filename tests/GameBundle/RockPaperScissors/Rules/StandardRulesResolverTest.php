<?php

namespace Tests\GameBundle\RockPaperScissors\Card;

use GameBundle\RockPaperScissors\Card\LizardCard;
use GameBundle\RockPaperScissors\Card\PaperCard;
use GameBundle\RockPaperScissors\Card\RockCard;
use GameBundle\RockPaperScissors\Card\ScissorsCard;
use GameBundle\RockPaperScissors\Card\SpockCard;
use GameBundle\RockPaperScissors\Rule\StandardRuleResolver;
use PHPUnit\Framework\TestCase;

class StandardRulesResolverTest extends TestCase
{
    public function testChoice()
    {
        $resolver = new StandardRuleResolver();

        $this->assertEquals('won', $resolver->resolve(new ScissorsCard(), new LizardCard()));
        $this->assertEquals('won', $resolver->resolve(new ScissorsCard(), new PaperCard()));
        $this->assertEquals('lost', $resolver->resolve(new ScissorsCard(), new RockCard()));
        $this->assertEquals('lost', $resolver->resolve(new ScissorsCard(), new SpockCard()));
        $this->assertEquals('draw', $resolver->resolve(new ScissorsCard(), new ScissorsCard()));

        $this->assertEquals('lost', $resolver->resolve(new SpockCard(), new LizardCard()));
        $this->assertEquals('lost', $resolver->resolve(new SpockCard(), new PaperCard()));
        $this->assertEquals('won', $resolver->resolve(new SpockCard(), new RockCard()));
        $this->assertEquals('draw', $resolver->resolve(new SpockCard(), new SpockCard()));
        $this->assertEquals('won', $resolver->resolve(new SpockCard(), new ScissorsCard()));

        $this->assertEquals('won', $resolver->resolve(new RockCard(), new LizardCard()));
        $this->assertEquals('lost', $resolver->resolve(new RockCard(), new PaperCard()));
        $this->assertEquals('draw', $resolver->resolve(new RockCard(), new RockCard()));
        $this->assertEquals('lost', $resolver->resolve(new RockCard(), new SpockCard()));
        $this->assertEquals('won', $resolver->resolve(new RockCard(), new ScissorsCard()));

        $this->assertEquals('lost', $resolver->resolve(new PaperCard(), new LizardCard()));
        $this->assertEquals('draw', $resolver->resolve(new PaperCard(), new PaperCard()));
        $this->assertEquals('won', $resolver->resolve(new PaperCard(), new RockCard()));
        $this->assertEquals('won', $resolver->resolve(new PaperCard(), new SpockCard()));
        $this->assertEquals('lost', $resolver->resolve(new PaperCard(), new ScissorsCard()));

        $this->assertEquals('draw', $resolver->resolve(new LizardCard(), new LizardCard()));
        $this->assertEquals('won', $resolver->resolve(new LizardCard(), new PaperCard()));
        $this->assertEquals('lost', $resolver->resolve(new LizardCard(), new RockCard()));
        $this->assertEquals('won', $resolver->resolve(new LizardCard(), new SpockCard()));
        $this->assertEquals('lost', $resolver->resolve(new LizardCard(), new ScissorsCard()));
    }
}