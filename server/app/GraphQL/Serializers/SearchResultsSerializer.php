<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use Service\SearchService\SearchResult;

/**
 * Class SearchResultsSerializer
 * @package App\GraphQL\Serializers
 */
class SearchResultsSerializer extends AbstractSerializer
{
    /**
     * @param SearchResult $dto
     * @return array
     */
    public function toArray($dto): array
    {
        return [
            'slug'    => $dto->slug,
            'url'     => $dto->url,
            'content' => $dto->body,
            'title'   => $dto->title,
            'type'    => $dto->type,
        ];
    }
}