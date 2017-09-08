<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use Railt\Adapters\InputInterface;

/**
 * Class DocsVersionsController
 * @package App\Http\Controllers
 */
class DocsVersionsController
{
    public function index(InputInterface $input)
    {
        dd($input->all());
    }
}
