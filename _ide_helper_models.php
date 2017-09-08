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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocsPage[] $pages
 */
	class DocsCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DocsPage.
 *
 * @property-read \App\Models\DocsCategory $category
 * @property-read \App\Models\DocsVersions $versions
 */
	class DocsPage extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DocsVersions.
 *
 * @property array $importer_config
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocsPage[] $pages
 * @property-read \App\Models\DocsProject $project
 */
	class DocsVersions extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DocsProjects
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocsVersions[] $versions
 */
	class DocsProject extends \Eloquent {}
}

