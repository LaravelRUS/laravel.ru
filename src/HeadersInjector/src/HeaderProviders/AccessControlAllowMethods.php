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
class AccessControlAllowMethods extends AsIs
{
    /**
     * @return Collection
     */
    public static function all(): Collection
    {
        $methods = [
            'GET',
            'PUT',
            'POST',
            'HEAD',
            'PATCH',
            'DELETE',
            'OPTIONS',
        ];

        return new Collection($methods);
    }
}
