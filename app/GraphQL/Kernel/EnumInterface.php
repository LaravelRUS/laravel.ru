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

/**
 * Interface EnumInterface
 *
 * @package App\GraphQL\Kernel
 */
interface EnumInterface
{
    /**
     * @return EnumType
     */
    public static function toGraphQL(): EnumType;
}