<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Controllers;

use App\GraphQL\Transformers\VersionsTransformer;
use App\Models\DocsVersions;
use Railt\Adapters\InputInterface;

/**
 * Class DocsVersionsController
 * @package App\GraphQL\Controllers
 */
class DocsVersionsController
{
    /**
     * @param InputInterface $input
     * @return iterable|null
     * @throws \LogicException
     */
    public function index(InputInterface $input)
    {
        $query = DocsVersions::query();

        return VersionsTransformer::apply($query->get());
    }
}
