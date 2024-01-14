<?php

return [
    'go_hello_addr' => env('RPC_HELLO_ADDR', 'tcp://go_hello_dev:6001'),

    'go_analyze_query' => env('RPC_HELLO_ADDR', 'tcp://go_analyze_query_dev:6001'),

    'python_hello_addr' => env('RPC_PYTHON_HELLO_ADDR', 'tcp://python_hello_dev:5555'),
];
