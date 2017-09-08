<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Controllers;

use App\GraphQL\Transformers\ProjectsTransformer;
use App\Models\DocsProject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Railt\Adapters\InputInterface;

/**
 * Class DocsProjectsController
 * @package App\GraphQL\Controllers
 */
class DocsProjectsController
{
    /**
     * @param InputInterface $input
     * @return iterable
     * @throws \LogicException
     */
    public function index(InputInterface $input): iterable
    {
        $query = $this->query();

        if ($input->has('newer')) {
            $date = Carbon::parse($input->get('newer'));
            $query->where('updated_at', '>=', $date);
        }

        return ProjectsTransformer::apply($query->get());
    }

    /**
     * @return Builder
     */
    private function query(): Builder
    {
        return DocsProject::query();
    }

    /**
     * @param InputInterface $input
     * @return null|array
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function show(InputInterface $input): ?array
    {
        $query = $this->query();

        if ($input->has('id')) {
            $query->where('id', $input->get('id'));
        }

        if ($input->has('slug')) {
            $query->where('slug', $input->get('slug'));
        }

        return ProjectsTransformer::apply($query->first());
    }
}
