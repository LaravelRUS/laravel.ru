<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Feature;

use CommerceGuys\Enum\AbstractEnum;
use GraphQL\Type\Definition\Type;
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
     */
    private function configs(array $config): array
    {
        if ($config['type'] instanceof Type) {
            return $config;
        }

        $config['type'] = $this->wrapType($config['type']);

        return $config;
    }

    /**
     * @param AbstractEnum|string|mixed $type
     * @return \GraphQL\Type\Definition\EnumType|mixed
     * @throws \ReflectionException
     */
    private function wrapType($type)
    {
        if (is_string($type) && is_subclass_of($type, AbstractEnum::class)) {
            return $this->transfer->toGraphQL($type);
        }

        return $type;
    }
}