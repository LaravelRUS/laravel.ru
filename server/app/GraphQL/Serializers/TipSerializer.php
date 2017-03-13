<?php

/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use App\Models\Tip;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipSerializer.
 */
class TipSerializer extends AbstractSerializer
{
    /**
     * @param  Tip|Model $tip
     * @return array
     */
    public function toArray($tip): array
    {
        return [
            'id'             => $tip->id,
            'content'        => $tip->content_rendered,
            'content_source' => $tip->content_source,
            'user'           => $tip->user,
            'likes'          => $tip->likes->count(),
            'dislikes'       => $tip->dislikes->count(),
        ];
    }
}
