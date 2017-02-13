<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\GraphQL\Types;

/**
 * Interface TypeInterface
 *
 * @package App\GraphQL\Types
 */
interface TypeInterface
{
    /**
     * @return string
     */
    public static function getName(): string;
}
