<?php

namespace app\helpers;


class DateHelper
{
    const SQL_FORMAT = 'Y-m-d';
    const USER_FORMAT = 'd.m.Y';

    public static function toSqlFormat(int $timestamp)
    {
        return date(self::SQL_FORMAT, $timestamp);
    }

    public static function toUserFormat(int $timestamp)
    {
        return date(self::USER_FORMAT, $timestamp);
    }
}