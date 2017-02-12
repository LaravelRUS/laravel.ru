<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models;

use App\Services\ColorGenerator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App\Models
 */
class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'color',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

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