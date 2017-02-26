<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\GitHub;

use Illuminate\Support\Collection;

/**
 * Interface DocsManagerInterface.
 */
interface DocsManagerInterface
{
    /**
     * @param  string                        $org
     * @param  string                        $repo
     * @param  string                        $branch
     * @return Collection|DocsStatus[]
     */
    public function findFiles(string $org, string $repo, string $branch);

    /**
     * @param  string           $org
     * @param  string           $repo
     * @param  string           $branch
     * @param  string           $file
     * @return ExternalDocsPage
     */
    public function import(string $org, string $repo, string $branch, string $file): ExternalDocsPage;
}
