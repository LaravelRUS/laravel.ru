<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Transformers;

use App\Models\DocsProject;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectsTransformer
 * @package App\GraphQL\Transformers
 */
class ProjectsTransformer extends Transformer
{
    /**
     * @param Model|DocsProject $project
     * @return iterable
     */
    protected function transform(Model $project): iterable
    {
        return [
            'id'        => $project->id,
            'title'     => $project->title,
            'slug'      => $project->slug,
            'image'     => $project->image,
            'createdAt' => $project->created_at,
            'updatedAt' => $project->updated_at,
        ];
    }
}
