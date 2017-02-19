<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

/**
 * Class ArticlePolicy
 * @package App\Policies
 */
class ArticlePolicy
{
    /**
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function view(User $user, Article $article)
    {
        return $article->isAllowedForUser($user);
    }
}
