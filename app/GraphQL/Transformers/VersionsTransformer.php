<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Transformers;

use App\Models\DocsVersions;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VersionsTransformer
 * @package App\GraphQL\Transformers
 */
class VersionsTransformer extends Transformer
{
    /**
     * @param Model|DocsVersions $version
     * @return iterable
     */
    protected function transform(Model $version): iterable
    {
        return [
            'id'        => $version->id,
            'version'   => $version->version,
            'createdAt' => $version->created_at,
            'updatedAt' => $version->updated_at,
        ];
    }
}
