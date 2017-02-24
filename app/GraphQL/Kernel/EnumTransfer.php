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
 * Class EnumTransfer.
 */
class EnumTransfer
{
    /**
     * @var array|EnumType[]
     */
    private $enums = [];

    /**
     * @param BaseEnum|string $enum
     * @param string          $shortName
     *
     * @return array
     */
    private function getGraphQLValues(string $enum, string $shortName): array
    {
        $values = [];

        foreach ($enum::getAll() as $key => $value) {
            $values[$value] = [
                'value'       => $value,
                'description' => sprintf('Enum type %s::%s', $shortName, $key),
            ];
        }

        return $values;
    }

    /**
     * @param BaseEnum|string $enum
     * @param string          $shortName
     *
     * @return EnumType
     */
    private function createGraphQLEnumType(string $enum, string $shortName): EnumType
    {
        return new EnumType([
            'name'        => $shortName,
            'description' => $shortName . ' type',
            'values'      => $this->getGraphQLValues($enum, $shortName),
        ]);
    }

    /**
     * @param string $enum
     *
     * @return mixed
     */
    public function toGraphQL(string $enum): EnumType
    {
        if (! array_key_exists($enum, $this->enums)) {
            $shortName = (new \ReflectionClass($enum))->getShortName();

            $this->enums[$enum] = $this->createGraphQLEnumType($enum, $shortName);
        }

        return $this->enums[$enum];
    }
}
