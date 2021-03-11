<?php

namespace PHPPM\Runtime;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Runtime\GenericRuntime;
use Symfony\Component\Runtime\RunnerInterface;

class SymfonyRuntime extends GenericRuntime
{
    private $port;
    private $host;
    private $workers;

    public function __construct(array $options)
    {
        $this->port = $options['port'];
        $this->host = $options['host'];
        $this->workers = $options['workers'];
        parent::__construct($options);
    }

    public function getRunner(?object $application): RunnerInterface
    {
        if ($application instanceof HttpKernelInterface) {
            return new Runner($application, $this->port, $this->host, $this->workers);
        }

        return parent::getRunner($application);
    }
}
