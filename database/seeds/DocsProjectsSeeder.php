<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class DocsProjectsSeeder
 */
class DocsProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \DB::table('docs_projects')->truncate();

        foreach ($this->getData() as $item) {
            $item = (array)$item;
            $item['created_at'] = $item['updated_at'] = Carbon::now();

            \DB::table('docs_projects')->insert($item);
        }
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        return [
            [
                'title'           => 'Документация Laravel',
                'slug'            => 'laravel',
                'description'     => 'Русский перевод документации Laravel Framework',
            ],
        ];
    }
}
