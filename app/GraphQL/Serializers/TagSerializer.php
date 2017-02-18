<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TagSerializer.
 */
class TagSerializer extends AbstractSerializer
{
    /**
     * @param Tag|Model $tag
     *
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
