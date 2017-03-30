<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Kernel\HasValidation;
use Folklore\GraphQL\Support\Mutation;

/**
 * Class AbstractMutation
 * @package App\GraphQL\Mutations
 */
abstract class AbstractMutation extends Mutation
{
    use HasValidation;
}