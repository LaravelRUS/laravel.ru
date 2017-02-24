<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\DataProviders;

use Illuminate\Support\Collection;

/**
 * Interface DataProviderInterface.
 */
interface DataProviderInterface
{
    /**
     * @param \DateTime $latest
     * @return ExternalArticle[]|Collection
     */
    public function getLatest(\DateTime $latest): Collection;
}