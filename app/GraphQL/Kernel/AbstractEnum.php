<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Kernel;

use GraphQL\Type\Definition\EnumType;
use CommerceGuys\Enum\AbstractEnum as BaseEnum;

/**
 * Class AbstractEnum.
 */
abstract class AbstractEnum extends BaseEnum implements EnumInterface
{
    /**
     * @var array
     */
    private static $enums = [];

    /**
     * @return EnumType
     */
    public static function toGraphQL(): EnumType
    {
        if (! array_key_exists(static::class, self::$enums)) {
            $shortName = (new \ReflectionClass(static::class))->getShortName();

            self::$enums[static::class] = new EnumType([
                'name'        => $shortName,
                'description' => $shortName . ' type',
                'values'      => self::getGraphQLValues($shortName),
            ]);
        }

        return self::$enums[static::class];
    }

    /**
     * @param  string $shortName
     * @return array
     */
    private static function getGraphQLValues(string $shortName)
    {
        $values = [];

        foreach (static::getAll() as $key => $value) {
            $values[$value] = [
                'value'       => $value,
                'description' => sprintf('Enum type %s::%s', $shortName, $key),
            ];
        }

        return $values;
    }
}
