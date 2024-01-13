<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\TestHelper;
use App\Jobs\TestJob;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use ZMQ;
use ZMQContext;
use ZMQSocket;
use ZMQSocketException;

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

    /**
     * Just a test to invoke the email.
     *
     * @param Request $request
     * @return string
     */
    public function startTestPythonZMQ(Request $request): string
    {
        /* Create new queue object */
        $socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, 'MySocket-test');

        /* Connect to an endpoint */

        $socket->setSockOpt(ZMQ::SOCKOPT_SNDTIMEO, 2 * 1000);
        $socket->setSockOpt(ZMQ::SOCKOPT_RCVTIMEO, 2 * 1000);

        $socket = $socket->connect("tcp://127.0.0.1:5555");

        try {
            $send = $socket->send("hello there, using MySocket-test", ZMQ::MODE_DONTWAIT);

            /* Send and receive */
            dump($send->recv(ZMQ::MODE_DONTWAIT));
        } catch (ZMQSocketException $e) {
            // ZMQ::ERR_EAGAIN
            dump(['msg' => $e->getMessage(), 'code' => $e->getCode()]);
        }

        return 'OK';
    }
}
