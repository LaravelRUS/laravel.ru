<?php declare(strict_types=1);

namespace App\Http\Controllers;


class HomeController
{
    public function index()
    {
        return view('page.home');
    }
}