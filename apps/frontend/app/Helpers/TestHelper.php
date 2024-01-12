<?php

namespace App\Helpers;

use Spiral\Goridge;

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
     */
    public static function currentDate(): string
    {
        $rpc = new Goridge\RPC\RPC(
            Goridge\Relay::create('tcp://goridge_hello_dev:6001')
        );

        /** @phpstan-ignore-next-line */
        return $rpc->call('App.CurrentDate', '2006-01-02 15:04:05');
    }
}
