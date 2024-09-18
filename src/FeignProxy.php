<?php

namespace hollisho\httpclient;

use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Exception\GuzzleException;
use hollisho\httpclient\Exceptions\NoBodyTypeProvidedException;
use hollisho\httpclient\Interpreters\ConfigInterpreter;
use hollisho\httpclient\Interpreters\MethodInterpreter;
use hollisho\objectbuilder\Exceptions\BuilderException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * @author Hollis
 * @desc
 * Class FeignProxy
 * @package hollisho\httpclient
 */
class FeignProxy
{

    private $client;

    private $reader;

    public function __construct($options = [])
    {
        $this->client = new BaseClient();

        if ($options) {
            $this->client::setDefaultOptions(array_merge($this->client::getDefaultOptions(), $options));
        }

        $this->reader = new AnnotationReader();
    }

    /**
     * @throws ReflectionException
     * @throws GuzzleException
     * @throws NoBodyTypeProvidedException
     * @throws BuilderException
     */
    public function call($object, $method, $arguments)
    {
        $reflectionClass = new ReflectionClass($object);
        $classAnnotations = $this->reader->getClassAnnotations($reflectionClass);
        $clientConfig = (new ConfigInterpreter($classAnnotations))->makeConfig();

        $this->client::setDefaultOptions(array_merge($this->client::getDefaultOptions(), $clientConfig));

        $reflectionMethod = new ReflectionMethod($object, $method);
        $annotations = $this->reader->getMethodAnnotations($reflectionMethod);

        $methods = (new MethodInterpreter([$reflectionMethod], [$annotations], $arguments))
            ->makeMethods();

        /** @var MethodVo $methods */
        $methods = $methods ? reset($methods) : [];

        $path = $methods->action->getEndpoint();
        $path = $this->generateUrlFromTemplate($methods->action->getEndpoint(), $methods->requestParams);

        $response = $this->client->request(
            $path,
            $methods->action->getMethod(),
            $methods->requestOptions);

        return $response->getBody();

    }

    /**
     * @param $template
     * @param $params
     * @return array|mixed|string|string[]
     * @author Hollis
     * @desc 处理url参数
     */
    function generateUrlFromTemplate($template, $params)
    {
        // 遍历参数数组，替换 URL 模板中的占位符
        foreach ($params as $key => $value) {
            if (is_array($value)) foreach ($value as $k => $v) {
                $template = str_replace('$' . $k, $v, $template);
            } else {
                $template = str_replace('$' . $key, $value, $template);
            }

        }

        return $template;
    }

}
