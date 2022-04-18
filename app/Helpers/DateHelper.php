<?php

namespace App\Helpers;

class DateHelper
{
    public static function getDayName(string $dayName): string
    {
        switch ($dayName) {
            case 'Monday':
                return 'Понеділок';
            case 'Tuesday':
                return 'Вівторок';
            case 'Wednesday':
                return 'Середа';
            case 'Thursday':
                return 'Четвер';
            case 'Friday':
                return 'П\'ятниця';
            case 'Saturday':
                return 'Субота';
            case 'Sunday':
                return 'Неділя';
        }
    }
}
