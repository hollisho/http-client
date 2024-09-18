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
    public static function create($interface, $options = [])
    {
        return new class($interface, $options) {
            private $feignProxy;
            private $interface;

            public function __construct($interface, $options = [])
            {
                $this->feignProxy = new FeignProxy($options);
                $this->interface = $interface;
            }

            public function __call($name, $arguments)
            {
                return $this->feignProxy->call($this->interface, $name, $arguments);
            }
        };
    }
}