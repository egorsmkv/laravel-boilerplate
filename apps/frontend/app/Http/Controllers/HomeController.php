<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\TestHelper;
use App\Jobs\TestJob;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $currentDate = TestHelper::currentDate();

        return view('home', compact('currentDate'));
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

    /**
     * Just a test to invoke the email.
     *
     * @param Request $request
     * @return string
     */
    public function startTestEmail(Request $request): string
    {
        Mail::to('user1@example.com')->send(new TestMail());

        return 'OK';
    }
}
