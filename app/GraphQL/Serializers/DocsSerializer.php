<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Serializers;

use App\Models\Docs;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocsSerializer.
 */
class DocsSerializer extends AbstractSerializer
{
    /**
     * @param  Model|Docs $docs
     * @return array
     */
    public function toArray(Model $docs): array
    {
        return [
            'id'          => $docs->id,
            'title'       => $docs->title,
            'image'       => $docs->image,
            'version'     => $docs->version,
            'description' => $docs->description,
            'created_at'  => $this->formatDateTime($docs->created_at),
            'updated_at'  => $this->formatDateTime($docs->updated_at),
            'pages'       => DocsPageSerializer::collection($docs->pages),
        ];
    }
}
