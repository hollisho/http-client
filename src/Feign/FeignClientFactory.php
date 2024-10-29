<?php

namespace hollisho\httpclient\Feign;

/**
 * @author Hollis
 * @desc
 * Class FeignClientFactory
 * @package hollisho\httpclient
 */
class FeignClientFactory
{
    public static function create($interface, $options = []): FeignClient
    {
        return new FeignClient($interface, $options);
    }
}