<?php

namespace hollisho\httpclient;

class FeignFactory
{
    public static function create($interface)
    {
        return new class($interface) {
            private $feignClient;
            private $interface;

            public function __construct($interface)
            {
                $this->feignClient = new FeignClient('');
                $this->interface = $interface;
            }

            public function __call($name, $arguments)
            {
                return $this->feignClient->call($this->interface, $name, $arguments);
            }
        };
    }
}