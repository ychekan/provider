<?php
declare(strict_types=1);

namespace App\Helpers;

class CacheHelper
{
    const string PROVIDERS_LIST_TTL = 'providers:';

    const int DEFAULT_CACHE_TTL = 300; // 5 minutes

    const int LARGE_CACHE_TTL = 3600; // 1 hour

    public static function makeListKey(?string $suffix = 'list:all'): string
    {
        return self::PROVIDERS_LIST_TTL . $suffix;
    }
}
