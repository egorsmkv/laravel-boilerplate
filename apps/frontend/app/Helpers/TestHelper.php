<?php

namespace App\Helpers;

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
}
