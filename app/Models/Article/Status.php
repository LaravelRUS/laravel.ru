<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models\Article;

use CommerceGuys\Enum\AbstractEnum;
use GraphQL\Type\Definition\EnumType;

/**
 * Class Status
 * @package App\Models\Article
 */
final class Status extends AbstractEnum
{
    const DRAFT = 'Draft';
    const REVIEW = 'Review';
    const PUBLISHED = 'Published';

    /**
     * @return EnumType
     */
    public static function toGraphQL(): EnumType
    {
        return new EnumType([
            'name'        => 'Status',
            'description' => 'Article status type',
            'values'      => [
                static::DRAFT     => [
                    'value'       => static::DRAFT,
                    'description' => 'Article is a draft and visible only for author and moderators',
                ],
                static::PUBLISHED => [
                    'value'       => static::PUBLISHED,
                    'description' => 'Article is active and visible for all users',
                ],
                static::REVIEW    => [
                    'value'       => static::REVIEW,
                    'description' => 'Article into a review status and will be published later',
                ],
            ],
        ]);
    }
}
