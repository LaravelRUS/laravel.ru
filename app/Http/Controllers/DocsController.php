<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Docs;
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
            'latest' => Docs::latest('updated_at')->take(10)->get()
        ]);
    }

    /**
     * @param string $version
     * @param string $slug
     * @return View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|View
     */
    public function show(string $version, string $slug): View
    {
        $docs = Docs::where('version', $version)->where('slug', $slug)->firstOrFail();

        return view('page.docs.show', [
            'docs' => $docs
        ]);
    }
}