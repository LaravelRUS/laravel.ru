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
 * Class UrlObserver.
 */
class UrlObserver
{
    /**
     * @param Docs $docs
     */
    public function saving(Docs $docs): void
    {
        $docs->url = $docs->version . '/' . $docs->slug;
    }
}