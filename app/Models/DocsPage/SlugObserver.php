<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\DocsPage;

use App\Models\DocsPage;
use Illuminate\Support\Str;

/**
 * Class SlugObserver.
 */
class SlugObserver
{
    /**
     * @param DocsPage $page
     */
    public function saving(DocsPage $page): void
    {
        if (! $page->slug) {
            $page->slug = Str::slug($page->title);
        }
    }
}