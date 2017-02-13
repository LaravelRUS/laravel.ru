<?php declare(strict_types = 1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\GraphQL\Serializers;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TagSerializer
 *
 * @package App\GraphQL\Serializers
 */
class TagSerializer extends AbstractSerializer
{
    /**
     * @param Tag|Model $tag
     * @return array
     */
    public function toArray(Model $tag): array
    {
        return [
            'id'    => $tag->id,
            'name'  => $tag->name,
            'color' => $tag->color,
        ];
    }
}
