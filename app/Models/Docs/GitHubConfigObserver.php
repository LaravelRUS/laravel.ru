<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Docs;

use App\Models\Docs;
use App\Services\GitHub\GitHubConfigRepository;

/**
 * Class GitHubConfigObserver.
 */
class GitHubConfigObserver
{
    /**
     * @var GitHubConfigRepository
     */
    private $config;

    /**
     * GitHubConfigObserver constructor.
     * @param GitHubConfigRepository $config
     */
    public function __construct(GitHubConfigRepository $config)
    {
        $this->config = $config;
    }

    /**
     * @param Docs $docs
     */
    public function creating(Docs $docs): void
    {
        if (! $docs->github_org) {
            $docs->github_org = $this->config->getOrg();
        }

        if (! $docs->github_repo) {
            $docs->github_repo = $this->config->getRepo();
        }

        if (! $docs->github_branch) {
            $docs->github_branch = $this->config->getBranch();
        }
    }
}
