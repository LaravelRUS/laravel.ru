<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Models\Docs;

use App\Models\Docs;
use Illuminate\Support\Str;

/**
 * Class SlugObserver.
 */
class SlugObserver
{
    /**
     * @param Docs $docs
     */
    public function saving(Docs $docs): void
    {
        if (! $docs->slug) {
            $docs->slug = Str::slug($docs->title);
        }
    }
}
