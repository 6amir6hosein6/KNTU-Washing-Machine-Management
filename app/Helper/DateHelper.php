<?php

namespace App\Helper;

use DateTime;
use Exception;
use IntlDateFormatter;
use Morilog\Jalali\Jalalian;
use Throwable;

class DateHelper
{
    public static function getMonthNamesInJalali(): array
    {
        $month = [];
        for ($i = 1; $i <= 12; $i++) {
            $month[] = (new IntlDateFormatter(
                'fa_IR@calendar=persian',
                IntlDateFormatter::FULL,
                IntlDateFormatter::NONE,
                null,
                IntlDateFormatter::TRADITIONAL,
                'MMMM'
            ))->format((new Jalalian(Jalalian::now()->getYear(), $i, 1))->toCarbon());
        }
        return $month;
    }

    /**
     * @throws Exception
     */
    public static function getFirstAndLastDayOfMonth(int $year, int $month): array
    {
        if ($month < 1 || $month > 12) {
            throw new Exception();
        }
        $firstDay = 1;
        $lastDay = 30;

        $firstDayOfMonth = new Jalalian($year, $month, $firstDay);

        if ($month <= 6) {
            $lastDay = 31;
        }

        if ((!(new Jalalian($year, $month, $firstDay))->isLeapYear()) && $month == 12) {
            $lastDay = 29;
        }

        $lastDayOfMonth = new Jalalian($year, $month, $lastDay);

        return [
            'first_day' => $firstDayOfMonth,
            'last_day' => $lastDayOfMonth
        ];
    }

    public static function jalaliToGregorian(
        mixed $date,
        string $fromFormat = 'Y/m/d',
        string $toFormat = 'Y-m-d'
    ): ?string {
        try {
            return Jalalian::fromFormat($fromFormat, strval($date))->toCarbon()->format($toFormat);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @throws Exception
     */
    public static function gregorianToJalali(mixed $date, string $format = 'YYYY/MM/dd HH:mm:ss'): bool|string
    {
        return (new IntlDateFormatter(
            'es_US@calendar=persian',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            null,
            IntlDateFormatter::TRADITIONAL,
            $format
        ))->format((new DateTime(strval($date)))->getTimestamp());
    }

    public static function getCurrentWeek(): array
    {
        $name = [
            'Sat' => 'شنبه',
            'Sun' => 'یکشنبه',
            'Mon' => 'دوشنبه',
            'Tue' => 'سه‌شنبه',
            'Wed' => 'چهارشنبه',
            'Thu' => 'پنجشنبه',
            'Fri' => 'جمعه',
        ];
        $currentDate = new DateTime();
        $startOfWeek = clone $currentDate;
        $formatter = new IntlDateFormatter(
            "en_US@calendar=persian",
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Asia/Tehran',
            IntlDateFormatter::TRADITIONAL,
            "yyyy-MM-dd");

        // If today is before Saturday, set the start of the week to the upcoming Saturday
        if ($currentDate->format('N') < 6) {
            $startOfWeek->modify('previous Saturday');
        }

        $week = [];

        for ($i = 0; $i < 7; $i++) {
            $day = clone $startOfWeek;
            $day->modify("+$i days");

            $dateString = $day->format('Y-m-d');
            $dayName = $name[$day->format('D')];
            $isToday = $day->format('Y-m-d') === $currentDate->format('Y-m-d');
            $isFuture = $day->format('Y-m-d') > $currentDate->format('Y-m-d');
            $status = 0;
            $status = $isToday? 1 : $status;
            $status = $isFuture? 2 : $status;

            $week[] = [
                'date' => $dateString,
                'status' => $status,
                'dayName' => $dayName,
            ];
        }


        return $week;
    }
}
