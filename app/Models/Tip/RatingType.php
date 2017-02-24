<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Tip;

use CommerceGuys\Enum\AbstractEnum;

/**
 * Class RatingType.
 */
final class RatingType extends AbstractEnum
{
    public const LIKE = 'Like';
    public const DISLIKE = 'Dislike';
}