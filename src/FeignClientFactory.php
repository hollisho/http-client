<?php

namespace hollisho\httpclient;

/**
 * @author Hollis
 * @desc
 * Class FeignClientFactory
 * @package hollisho\httpclient
 */
class FeignClientFactory
{
    public static function create($interface)
    {
        return new class($interface) {
            private $feignProxy;
            private $interface;

            public function __construct($interface)
            {
                $this->feignProxy = new FeignProxy();
                $this->interface = $interface;
            }

            public function __call($name, $arguments)
            {
                return $this->feignProxy->call($this->interface, $name, $arguments);
            }
        };
    }
}