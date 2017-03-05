<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleSerializer.
 */
class ArticleSerializer extends AbstractSerializer
{
    /**
     * @param  Article|Model $article
     * @return array
     */
    public function toArray(Model $article): array
    {
        return [
            'id'             => $article->id,
            'title'          => $article->capitalize_title,
            'url'            => route('articles.show', ['slug' => $article->slug]),
            'image'          => $article->image_url,
            'content'        => $article->content_rendered,
            'content_source' => $article->content_source,
            'preview'        => $article->preview_rendered,
            'preview_source' => $article->preview_source,
            'status'         => $article->status,
            'published_at'   => $this->formatDateTime($article->published_at),
            'user'           => UserSerializer::serialize($article->user),
            'tags'           => TagSerializer::collection($article->tags),
        ];
    }
}
