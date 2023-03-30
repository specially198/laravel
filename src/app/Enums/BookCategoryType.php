<?php

namespace App\Enums;

final class BookCategoryType
{
    const NOVEL = '1';
    const SPORTS = '2';
    const PROGRAMMING = '3';
    const BUSINESS = '4';
    const OTHER = '99';

    public static function getDescription($value): string
    {
        switch($value) {
            case self::NOVEL:
                return '小説';
            case self::SPORTS:
                return 'スポーツ';
            case self::PROGRAMMING:
                return 'プログラミング';
            case self::BUSINESS:
                return 'ビジネス';
            case self::OTHER:
                return 'その他';
            default :
                return $value;
        }
    }
}
