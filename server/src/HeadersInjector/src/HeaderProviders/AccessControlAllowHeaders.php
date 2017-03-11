<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\HeadersInjector\HeaderProviders;

use Illuminate\Support\Collection;

/**
 * Class AccessControlAllowMethods.
 */
class AccessControlAllowHeaders extends AsIs
{
    /**
     * @return Collection
     */
    public static function all(): Collection
    {
        return static::getDefaults()
            ->merge(static::getXHeaders());
    }

    /**
     * @return Collection
     */
    public static function getDefaults(): Collection
    {
        $headers = [
            'DNT',
            'Host',
            'Pragma',
            'Origin',
            'Accept',
            'Referer',
            'Connection',
            'User-Agent',
            'Keep-Alive',
            'Content-Type',
            'Cache-Control',
            'Authorization',
            'Accept-Charset',
            'Content-Length',
            'Accept-Encoding',
            'Accept-Language',
            'If-Modified-Since',
        ];

        return new Collection($headers);
    }

    /**
     * @return Collection
     */
    public static function getXHeaders(): Collection
    {
        $headers = [
            'X-Key',
            'X-Api-Token',
            'X-Access-Token',
            'X-Requested-With',
        ];

        return new Collection($headers);
    }
}
