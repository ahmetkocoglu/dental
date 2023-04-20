<?php

namespace App\Helpers;

use App\Constants\DateConstants;
use Illuminate\Support\Carbon;

class DateHelper
{
    public static function now(): Carbon
    {
        return Carbon::now();
    }

    public static function createFromTimeString(string $time): Carbon
    {
        return Carbon::parse($time);
    }

    public static function parse(Carbon|string $time): Carbon
    {
        return Carbon::parse($time);
    }

    public static function format(string $format = DateConstants::DATE_TIME_FORMAT, Carbon|string $time = null): string
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::parse($time);
        }

        return $time->format($format);
    }

    public static function today(): Carbon
    {
        return Carbon::today();
    }

    public static function addMinutes(int $minutes = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::createFromTimeString($time);
        }

        return $time->addMinutes($minutes);
    }

    public static function addDays(int $days = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::parse($time);
        }

        return $time->addDays($days);
    }

    public static function addMonths(int $months = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::parse($time);
        }

        return $time->addMonths($months);
    }

    public static function addYears(int $years = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::parse($time);
        }

        return $time->addYears($years);
    }

    public static function subMinutes(int $minutes = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::createFromTimeString($time);
        }

        return $time->subMinutes($minutes);
    }

    public static function subDay(int $days = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::parse($time);
        }

        return $time->subDays($days);
    }

    public static function subMonths(int $months = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::parse($time);
        }

        return $time->subMonths($months);
    }

    public static function subYears(int $years = 1, Carbon|string $time = null): Carbon
    {
        if (null === $time) {
            $time = self::now();
        }

        if (is_string($time)) {
            $time = self::parse($time);
        }

        return $time->subYears($years);
    }

    public static function diffForHumansFromNow(): string
    {
        return self::now()->diffForHumans();
    }

    public static function diffForHumansFromDate(Carbon|string $time): string
    {
        if (is_string($time)) {
            return self::createFromTimeString($time)->diffForHumans();
        }

        return $time->diffForHumans();
    }

    public static function isLessThanOrEqualFromNow(Carbon|string $time): bool
    {
        return self::parse($time)->lessThanOrEqualTo(self::now());
    }

    public static function isLesserFromNow(Carbon|string $time): bool
    {
        return self::parse($time)->lessThan(self::now());
    }

    public static function isGreaterThanOrEqualFromNow(Carbon|string $time): bool
    {
        return self::parse($time)->greaterThanOrEqualTo(self::now());
    }

    public static function isGreaterFromNow(Carbon|string $time): bool
    {
        return self::parse($time)->greaterThan(self::now());
    }
}
