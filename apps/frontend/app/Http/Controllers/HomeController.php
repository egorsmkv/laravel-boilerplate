<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('home');
    }

    /**
     * Just a test to invoke the job.
     *
     * @param Request $request
     * @return string
     */
    public function startTestJob(Request $request): string
    {
        TestJob::dispatch(10);

        return 'OK';
    }
}
