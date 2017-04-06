<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Service\DocsImporter\DocsConnectionConfigInterface;

/**
 * Class Docs.
 */
class Docs extends Model
{
    /**
     * @var string
     */
    protected $table = 'docs';

    /**
     * @var array
     */
    protected $casts = [
        'importer_config' => 'collection',
    ];

    /**
     * @return HasMany
     */
    public function pages(): HasMany
    {
        return $this->hasMany(DocsPage::class, 'docs_id', 'id');
    }

    /**
     * @param DocsConnectionConfigInterface|array $config
     */
    public function setImporterConfigAttribute($config)
    {
        $this->attributes['importer_config'] = $config instanceof Arrayable
            ? $config->toArray()
            : json_encode($config);
    }

    /**
     * @param  string $data
     * @return array
     */
    public function getImporterConfigAttribute(string $data): array
    {
        if ($data) {
            return json_decode($data, true);
        }

        return [];
    }
}
