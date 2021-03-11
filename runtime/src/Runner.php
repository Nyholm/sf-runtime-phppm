<?php

namespace PHPPM\Runtime;


use PHPPM\ProcessManager;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Runtime\RunnerInterface;

class Runner implements RunnerInterface
{
    private $application;
    private $port;
    private $host;
    private $workers;

    public function __construct(HttpKernelInterface $application, int $port, string $host, int $workers)
    {
        $this->application = $application;
        $this->port = $port;
        $this->host = $host;
        $this->workers = $workers;
    }

    public function run(): int
    {
        $application = $this->application;
        $handler = new ProcessManager(new ConsoleOutput(), $this->port, $this->host, $this->workers);

        $handler->run();

        return 0;
    }
}