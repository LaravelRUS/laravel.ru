<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class DocsCategory.
 *
 * @property int $id
 * @property int $order_id
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocsPage[] $pages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsCategory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsCategory whereTitle($value)
 */
	class DocsCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DocsPage.
 *
 * @property int $id
 * @property int|null $category_id
 * @property int $docs_id
 * @property string $identify
 * @property string $hash
 * @property string $title
 * @property string $slug
 * @property string $content_source
 * @property string $content_rendered
 * @property \Illuminate\Support\Collection $nav
 * @property int $order_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\DocsCategory|null $category
 * @property-read \App\Models\DocsVersions $versions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereContentRendered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereContentSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereDocsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereNav($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsPage whereUpdatedAt($value)
 */
	class DocsPage extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DocsProjects
 *
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $image
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocsVersions[] $versions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsProject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsProject whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsProject whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsProject whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsProject whereUpdatedAt($value)
 */
	class DocsProject extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DocsVersions.
 *
 * @property int $id
 * @property int $project_id
 * @property string $version
 * @property string $renderer
 * @property string $importer
 * @property array $importer_config
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocsPage[] $pages
 * @property-read \App\Models\DocsProject $project
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereImporter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereImporterConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereRenderer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocsVersions whereVersion($value)
 */
	class DocsVersions extends \Eloquent {}
}

