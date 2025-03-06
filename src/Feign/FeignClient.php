<?php

namespace hollisho\httpclient\Feign;

use GuzzleHttp\Exception\GuzzleException;
use hollisho\httpclient\Exceptions\NoBodyTypeProvidedException;
use Psr\Http\Message\ResponseInterface;

class FeignClient
{

    /**
     * 代理类
     * @var FeignProxy
     */
    private $feignProxy;

    private $interface;

    public function __construct($interface, $options = [])
    {
        $this->feignProxy = new FeignProxy($options);
        $this->interface = $interface;
    }

    /**
     * 调用目标对象的方法
     * @param $name
     * @param $arguments
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws \ReflectionException
     * @throws NoBodyTypeProvidedException
     * @author Hollis
     */
    public function __call($name, $arguments)
    {
        return $this->feignProxy->call($this->interface, $name, $arguments);
    }

    /**
     * 设置Client默认Options
     * @param array $options
     * @return void
     * @author Hollis
     */
    public function setDefaultOptions(array $options = [])
    {
        $this->feignProxy->setDefaultOptions($options);
    }
}