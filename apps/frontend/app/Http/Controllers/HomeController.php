<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        return view('home');
    }
}
