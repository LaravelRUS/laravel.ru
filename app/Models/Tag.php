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

/**
 * Class Tag.
 */
class Tag extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'color',
    ];

    /**
     * @param ColorGenerator $generator
     * @return Tag
     */
    public function updateColor(ColorGenerator $generator): Tag
    {
        $this->color = $generator->make(true);

        return $this;
    }
}
