<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\GraphQL\Queries;

use App\GraphQL\Types\ArticleType;
use App\Models\Tag;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Models\Article;

/**
 * Class ArticlesQuery
 * @package App\GraphQL
 */
class ArticlesQuery extends Query
{
    /**
     * @return GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(GraphQL::type(ArticleType::class));
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id'     => [
                'type'        => Type::id(),
                'description' => '',
            ],
            'status' => [
                'type'        => Type::string(),
                'description' => '',
            ],
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @return \Illuminate\Support\Collection
     * @throws \InvalidArgumentException
     */
    public function resolve($root, array $args = [])
    {
        $query = Article::query()
            ->with('user')
            ->with('tags');

        if (isset($args['status']) && !Article\Status::exists($args['status'])) {
            throw new \InvalidArgumentException('Invalid status type');
        }

        foreach ($args as $field => $value) {
            $query = $query->where($field, $value);
        }

        return $query->get()
            ->map(function (Article $article) {
                return [
                    'id'           => $article->id,
                    'title'        => $article->capitalize_title,
                    'url'          => route('article', ['slug' => $article->slug]),
                    'image'        => $article->image_url,
                    'content'      => $article->content_rendered,
                    'status'       => $article->status,
                    'published_at' => $article->published_at->toRfc3339String(),

                    'user' => [
                        'id'           => $article->user->id,
                        'name'         => $article->user->name,
                        'email'        => $article->user->email,
                        'avatar'       => $article->user->avatar,
                        'is_confirmed' => $article->user->is_confirmed,
                    ],

                    'tags' => $article->tags->map(function (Tag $tag) {
                        return [
                            'id'    => $tag->id,
                            'name'  => $tag->name,
                            'color' => $tag->color,
                        ];
                    }),
                ];
            });
    }
}