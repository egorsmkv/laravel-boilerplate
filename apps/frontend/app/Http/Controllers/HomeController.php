<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
     * @throws ZMQSocketException
     */
    public function startTestPythonZMQ(Request $request): string
    {
        // Create a new socket
        $socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, 'MySocket-test');

        // Connect to an endpoint with some configuration

        // $socket->setSockOpt(ZMQ::SOCKOPT_SNDTIMEO, 2 * 1000);
        // $socket->setSockOpt(ZMQ::SOCKOPT_RCVTIMEO, 2 * 1000);
        // $socket->setSockOpt(ZMQ::SOCKOPT_TCP_KEEPALIVE_CNT, 10);
        // $socket->setSockOpt(ZMQ::SOCKOPT_TCP_KEEPALIVE_INTVL, 1);
        // $socket->setSockOpt(ZMQ::SOCKOPT_TCP_KEEPALIVE_IDLE, 1);

        /** @var string $zmqHost */
        $zmqHost = config('rpc.python_hello_addr');
        $socket = $socket->connect($zmqHost);

        for ($i = 1; $i <= 10; $i++) {
            try {
                // Send and receive
                $send = $socket->send(sprintf('hello there, using MySocket-test: %d', $i));
                $result = $send->recv();

                dump($result);

                echo sprintf('Python RPC result: %s', $result) . '<br>';
            } catch (ZMQSocketException $e) {
                // ZMQ::ERR_EAGAIN may happen
                dump(['msg' => $e->getMessage(), 'code' => $e->getCode()]);
            }
        }

        return 'OK';
    }
}
