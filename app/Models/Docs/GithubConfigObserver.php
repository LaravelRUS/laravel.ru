<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Docs;

use App\Models\Docs;

/**
 * Class GithubConfigObserver.
 */
class GithubConfigObserver
{
    private const DEFAULT_GITHUB_ORG = 'translation-gang';
    private const DEFAULT_GITHUB_REPO = 'ru.docs.laravel';
    private const DEFAULT_GITHUB_BRANCH = '5.4-ru';

    /**
     * @param Docs $docs
     */
    public function creating(Docs $docs): void
    {
        if (! $docs->github_org) {
            $docs->github_org = self::DEFAULT_GITHUB_ORG;
        }

        if (! $docs->github_repo) {
            $docs->github_repo = self::DEFAULT_GITHUB_REPO;
        }

        if (! $docs->github_branch) {
            $docs->github_branch = self::DEFAULT_GITHUB_BRANCH;
        }
    }
}
