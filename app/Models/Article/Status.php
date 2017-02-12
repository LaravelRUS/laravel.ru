<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models\Article;

use CommerceGuys\Enum\AbstractEnum;

/**
 * Class Status
 * @package App\Models\Article
 */
final class Status extends AbstractEnum
{
    const DRAFT = 'Draft';
    const REVIEW = 'Review';
    const PUBLISHED = 'Published';
}