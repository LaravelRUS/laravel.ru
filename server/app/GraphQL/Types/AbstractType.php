<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use Illuminate\Support\Str;
use App\GraphQL\Kernel\AttributeExists;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * Class AbstractType.
 */
abstract class AbstractType extends GraphQLType implements TypeInterface
{
    use AttributeExists;

    /**
     * @var array
     */
    private static $names = [];

    /**
     * @return string
     */
    public static function getName(): string
    {
        if (! isset(self::$names[static::class])) {
            $reflection = new \ReflectionClass(static::class);

            self::$names[static::class] = Str::replaceLast('Type', '', $reflection->getShortName());
        }

        return self::$names[static::class];
    }
}
