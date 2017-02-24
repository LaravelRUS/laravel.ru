<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DataProviders\Manager;

class TestController
{
    public function test(Manager $manager)
    {
        dd($manager);
    }
}
