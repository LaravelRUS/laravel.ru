<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Feature;

use GraphQL\Type\Definition\Type;
use CommerceGuys\Enum\AbstractEnum;
use App\GraphQL\Feature\Enum\EnumTransfer;
use App\GraphQL\Feature\Kernel\FeaturesSupport;

/**
 * Class EnumsSupport
 * @package App\GraphQL\Feature
 * @mixin FeaturesSupport
 */
trait EnumsSupport
{
    /**
     * @var EnumTransfer
     */
    private $transfer;

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function bootEnumsSupport(): void
    {
        $this->transfer = new EnumTransfer();

        $this->addFieldsWrapper(function (array $arguments) {
            foreach ($arguments as $key => $data) {
                yield $key => $this->configs($data);
            }
        });
    }

    /**
     * @param array $config
     * @return array
     * @throws \ReflectionException
     */
    private function configs(array $config): array
    {
        if (! $this->isGraphQLType($config)) {
            $config['type'] = $this->wrapType($config['type']);
        }

        return $config;
    }

    /**
     * @param array $config
     * @return bool
     */
    private function isGraphQLType(array $config): bool
    {
        return $config['type'] instanceof Type;
    }

    /**
     * @param AbstractEnum|string|mixed $type
     * @return bool
     */
    private function isEnumType($type): bool
    {
        return is_string($type) && is_subclass_of($type, AbstractEnum::class);
    }

    /**
     * @param AbstractEnum|string|mixed $type
     * @return \GraphQL\Type\Definition\EnumType|mixed
     * @throws \ReflectionException
     */
    private function wrapType($type)
    {
        if ($this->isEnumType($type)) {
            return $this->transfer->toGraphQL($type);
        }

        return $type;
    }
}