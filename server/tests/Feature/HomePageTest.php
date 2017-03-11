<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomePageTest extends TestCase
{
    use DatabaseMigrations;

    public function testHomePageAvailable()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
