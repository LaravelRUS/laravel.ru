<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Article;

use App\GraphQL\Kernel\AbstractEnum;

/**
 * Class Status.
 */
final class Status extends AbstractEnum
{
    const DRAFT = 'Draft';
    const REVIEW = 'Review';
    const PUBLISHED = 'Published';
}
