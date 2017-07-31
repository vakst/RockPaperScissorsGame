<?php

namespace GameBundle\RockPaperScissors\Card;

class CardType
{
    /**
     * @var array
     */
    private static $map = array(
        RockCard::class,
        PaperCard::class,
        ScissorsCard::class,
        LizardCard::class,
        SpockCard::class
    );

    /**
     * Get card by mame
     * @param $name
     * @return ICard | null
     */
    public static function getCardByNameList(string $name)
    {
        foreach (self::$map as $value) {
            if ($value::getName() == $name) {
                return new $value;
            }
        }

        return null;
    }

    public static function getList(): array
    {
        return self::$map;
    }

    /**
     * Get named list of cards
     * @return array
     */
    public static function getNamedCardList(): array
    {
        $result = array();
        foreach (self::$map as $value) {
            $result[] = $value::getName();
        }

        return $result;
    }
}