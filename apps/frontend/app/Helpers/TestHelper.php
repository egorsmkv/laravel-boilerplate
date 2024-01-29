<?php

namespace App\Helpers;

use ZMQ;
use ZMQContext;
use ZMQSocket;
use ZMQSocketException;

class TestHelper
{
    /**
     * Returns the concatenation of two strings formatted as "<$v1> - <$v2>".
     *
     * @param string $v1 The first string.
     * @param string $v2 The second string.
     * @return string The concatenated string.
     */
    public static function test(string $v1, string $v2): string
    {
        return sprintf('%s - %s', $v1, $v2);
    }

    /**
     * Returns the current date and time formatted as "Y-m-d H:i:s".
     *
     * @return string The formatted date and time returned from the Go service.
     * @throws ZMQSocketException
     */
    public static function currentDate(): string
    {
        // Create a new socket
        $socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, 'MySocket-test1');

        // Connect to an endpoint with some configuration

        // $socket->setSockOpt(ZMQ::SOCKOPT_SNDTIMEO, 2 * 1000);
        // $socket->setSockOpt(ZMQ::SOCKOPT_RCVTIMEO, 2 * 1000);
        // $socket->setSockOpt(ZMQ::SOCKOPT_TCP_KEEPALIVE_CNT, 10);
        // $socket->setSockOpt(ZMQ::SOCKOPT_TCP_KEEPALIVE_INTVL, 1);
        // $socket->setSockOpt(ZMQ::SOCKOPT_TCP_KEEPALIVE_IDLE, 1);

        /** @var string $zmqHost */
        $zmqHost = config('rpc.go_hello_addr');
        $socket = $socket->connect($zmqHost);

        try {
            // Send and receive
            $send = $socket->send('2006-01-02 15:04:05');

            return $send->recv();
        } catch (ZMQSocketException $e) {
            return 'ERROR';
        }
    }
}
