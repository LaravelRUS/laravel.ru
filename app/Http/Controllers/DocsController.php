<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Docs;
use App\Models\DocsPage;
use Illuminate\Contracts\View\View;

/**
 * Class DocsController.
 */
class DocsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|View
     */
    public function index(): View
    {
        return view('page.docs.index', [
            'docs' => Docs::with('pages')
                ->latest('updated_at')
                ->get(),
        ]);
    }

    /**
     * @param  string                                                        $version
     * @param  string                                                        $slug
     * @return View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|View
     */
    public function show(string $version, string $slug): View
    {
        $page = DocsPage::with('docs')
            ->whereVersion($version)
            ->whereSlug($slug)
            ->firstOrFail();

        return view('page.docs.show', [
            'page' => $page,
        ]);
    }
}
