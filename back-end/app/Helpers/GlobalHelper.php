<?php

namespace App\Helpers;

class GlobalHelper
{
    public static function errorMessage(int $errorCode): string
    {
        return '' !== __('errors.code.' . $errorCode) ? __('errors.code.' . $errorCode) : __('errors.default.message');
    }
}
