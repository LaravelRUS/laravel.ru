<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Kernel;

/**
 * Class AttributeExists
 * @package App\GraphQL\Kernel
 */
trait AttributeExists
{
    /**
     * @param array $args
     * @param string $name
     * @param \Closure $then
     * @return mixed
     */
    protected function whenExists(array $args, string $name, \Closure $then)
    {
        if (isset($args[$name])) {
            return $then($args[$name]);
        }

        return null;
    }
}