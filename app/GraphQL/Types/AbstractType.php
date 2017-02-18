<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Str;

abstract class AbstractType extends GraphQLType implements TypeInterface
{
    private static $names = [];

    public static function getName(): string
    {
        if (!isset(self::$names[static::class])) {
            $reflection = new \ReflectionClass(static::class);

            self::$names[static::class] = Str::replaceLast('Type', '', $reflection->getShortName());
        }

        return self::$names[static::class];
    }
}
