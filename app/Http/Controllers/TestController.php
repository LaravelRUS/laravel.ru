<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers;


use GrahamCampbell\GitHub\GitHubManager;

class TestController
{
    public function test(GitHubManager $manager)
    {
        dd($manager->organization()->show('translation-gang'));
    }
}
