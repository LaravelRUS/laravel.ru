<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Service\DocsImporter\GitHub\GitHubConfig;

/**
 * Class DocsVersionsSeeder
 */
class DocsVersionsSeeder extends Seeder
{
    private const PROJECT_LARAVEL = 'laravel';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('docs_versions')->truncate();

        $projects = \DB::table('docs_projects')->get();

        foreach ($projects as $project) {
            $data = $this->getData((array)$project);

            if ($data && count($data)) {
                foreach ($data as $item) {
                    $item['created_at'] = $item['updated_at'] = Carbon::now();

                    \DB::table('docs_versions')->insert($item);
                }
            }
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function getData(array $data = []): array
    {
        $project = Arr::get($data, 'slug');

        switch ($project) {
            case self::PROJECT_LARAVEL:
                return $this->getLaravelData($data);
        }

        return [];
    }

    /**
     * @param array $data
     * @return array
     */
    private function getLaravelData(array $data = []): array
    {
        return [
            [
                'project_id'      => $data['id'],
                'version'         => '5.5',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.5',
                ]),
            ],
            [
                'project_id'      => $data['id'],
                'version'         => '5.4',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.4',
                ]),
            ],
            [
                'project_id'      => $data['id'],
                'version'         => '5.3',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.3',
                ]),
            ],
            [
                'project_id'      => $data['id'],
                'version'         => '5.2',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.2',
                ]),
            ],
            [
                'project_id'      => $data['id'],
                'version'         => '5.1',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.1',
                ]),
            ],
            [
                'project_id'      => $data['id'],
                'version'         => '5.0',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '5.0',
                ]),
            ],
            [
                'project_id'      => $data['id'],
                'version'         => '4.2',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '4.2',
                ]),
            ],
            [
                'project_id'      => $data['id'],
                'version'         => '4.1',
                'renderer'        => 'laravel-rus',
                'importer'        => 'github',
                'importer_config' => new GitHubConfig([
                    GitHubConfig::CONFIG_ORGANISATION => 'LaravelRUS',
                    GitHubConfig::CONFIG_REPOSITORY   => 'docs',
                    GitHubConfig::CONFIG_BRANCH       => '4.1',
                ]),
            ],
        ];
    }
}
