<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Models;

use App\Services\ColorGenerator;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name', 'color',
    ];

    public $timestamps = false;

    public function updateColor(ColorGenerator $generator): Tag
    {
        $this->color = $generator->make(true);

        return $this;
    }
}
