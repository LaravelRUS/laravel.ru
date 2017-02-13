<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\GraphQL\Types;

use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Str;

/**
 * Class AbstractType
 *
 * @package App\GraphQL\Types
 */
abstract class AbstractType extends GraphQLType implements TypeInterface
{
    /**
     * @var array
     */
    private static $names = [];

    /**
     * @return string
     */
    public static function getName(): string
    {
        if (!isset(self::$names[static::class])) {
            $reflection = new \ReflectionClass(static::class);

            self::$names[static::class] = Str::replaceLast('Type', '', $reflection->getShortName());
        }

        return self::$names[static::class];
    }
}
