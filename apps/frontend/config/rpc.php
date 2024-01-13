<?php

return [
    'hello_addr' => env('RPC_HELLO_ADDR', 'tcp://goridge_hello_dev:6001'),

    'python_hello_addr' => env('RPC_PYTHON_HELLO_ADDR', 'tcp://python_hello_dev:5555'),
];
