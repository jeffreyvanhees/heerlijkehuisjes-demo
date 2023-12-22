<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show all homes.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $homes = Home::paginate(10);

        return view('pages.homes.index', compact('homes'));
    }

    /**
     * Show a specific home.
     *
     * @param \App\Models\Home $home
     *
     * @return \Illuminate\View\View
     */
    public function show(Home $home): View
    {
        return view('pages.homes.show', compact('home'));
    }
}
