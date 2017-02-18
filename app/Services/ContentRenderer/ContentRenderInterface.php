<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ContentRenderer;

/**
 * Interface ContentRenderInterface.
 */
interface ContentRenderInterface
{
    /**
     * @param string $original
     *
     * @return string
     */
    public function renderBody(string $original): string;
}
