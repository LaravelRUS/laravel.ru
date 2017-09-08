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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Service\DocsImporter\DocsConnectionConfigInterface;

/**
 * Class DocsVersions.
 */
class DocsVersions extends Model
{
    /**
     * @var string
     */
    protected $table = 'docs_versions';

    /**
     * @var array
     */
    protected $casts = [
        'importer_config' => 'collection',
    ];

    /**
     * @var array
     */
    protected $with = [
        'project'
    ];

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(DocsProject::class, 'project_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function pages(): HasMany
    {
        return $this->hasMany(DocsPage::class, 'version_id', 'id');
    }

    /**
     * @param DocsConnectionConfigInterface|array $config
     */
    public function setImporterConfigAttribute($config): void
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
