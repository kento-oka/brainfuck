<?php
include __DIR__ . "/vendor/autoload.php";

$factory    = new \Fratily\Http\Message\StreamFactory();
$interpreter    = new \Kentoka\Brainfuck\Interpreter(new \Kentoka\Brainfuck\Memory\StdMemory());
$interpreter->exec(
    $factory->createStream("+++++++++[>++++++++>+++++++++++>+++++<<<-]>.>++.+++++++..+++.
>-------------.<<+++++++++++++++.>.+++.------.--------.>+.."),
    $factory->createStreamFromResource(STDIN),
    $factory->createStreamFromResource(STDOUT)
);
echo PHP_EOL,PHP_EOL;
$interpreter->exec(
    $factory->createStream("++++++++++++[->++++++>+++++++++>+++++>++++++++++>++++++++++>+++>>>>>>++++++++<<<<<<<<<<<<]>-->--->++
++++>--->++>---->>>>+++>+++++>++++[>>>+[-<<[->>+>+<<<]>>>[-<<<+>>>]+<[[-]>-<<[->+>+<<]>>[-<<+>>]+<[[
-]>-<<<+>->]>[-<<<--------->+++++++++>>>>>+<<<]<]>[-<+++++++[<<+++++++>>-]<++++++++>>]>>>]<<<<<<[<<<
<]>-[-<<+>+>]<[->+<]+<[[-]>-<]>[->+++<<<<<<<<<.>.>>>..>>+>>]>>-[-<<<+>+>>]<<[->>+<<]+<[[-]>-<]>[->>+
++++<<<<<<<<.>.>..>>+>>]<+<[[-]>-<]>[->>>>>[>>>>]<<<<[.<<<<]<]<<.>>>>>>-]"),
    $factory->createStreamFromResource(STDIN),
    $factory->createStreamFromResource(STDOUT)
);