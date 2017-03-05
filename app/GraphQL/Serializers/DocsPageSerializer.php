<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use App\GraphQL\Types\DocsPageType;
use App\Models\Docs;
use App\Models\DocsPage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocsSerializer
 * @package App\GraphQL\Serializers
 */
class DocsPageSerializer extends AbstractSerializer
{
    /**
     * @param Model|DocsPage $page
     * @return array
     */
    public function toArray(Model $page): array
    {
        return [
            'id'             => $page->id,
            'title'          => $page->title,
            'url'            => route('docs.show', [
                'version' => $page->docs->version,
                'slug'    => $page->slug,
            ]),
            'content'        => $page->content_rendered,
            'content_source' => $page->content_source,
            'created_at'     => $this->formatDateTime($page->created_at),
            'updated_at'     => $this->formatDateTime($page->updated_at),
        ];
    }
}