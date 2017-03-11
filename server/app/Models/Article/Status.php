<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Article;

use CommerceGuys\Enum\AbstractEnum;

/**
 * Class Status.
 */
final class Status extends AbstractEnum
{
    public const DRAFT = 'Draft';
    public const REVIEW = 'Review';
    public const PUBLISHED = 'Published';
}
