<?php

namespace App\Constants;

final class CardSuit
{

    public const SPADE = 'S';
    public const HEART = 'H';
    public const DIAMOND = 'D';
    public const CLUB = 'C';

    public const LIST = [
        self::SPADE => [
            'name' => 'Spade',
            'shortname' => 'S',
        ],
        self::HEART => [
            'name' => 'Heart',
            'shortname' => 'H',
        ],
        self::DIAMOND => [
            'name' => 'Diamond',
            'shortname' => 'D',
        ],
        self::CLUB => [
            'name' => 'Club',
            'shortname' => 'C',
        ],
    ];
}
