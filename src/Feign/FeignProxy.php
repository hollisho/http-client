<?php

namespace hollisho\httpclient\Feign;

use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Exception\GuzzleException;
use hollisho\httpclient\BaseClient;
use hollisho\httpclient\Exceptions\NoBodyTypeProvidedException;
use hollisho\httpclient\Http\RequestConfiguration;
use hollisho\httpclient\Interpreters\ConfigInterpreter;
use hollisho\httpclient\Interpreters\MethodInterpreter;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use hollisho\httpclient\Interpreters\MiddlewareInterpreter;

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
            $this->client->setDefaultOptions(array_merge($this->client->getDefaultOptions(), $options));
        }

        $this->reader = new AnnotationReader();
    }

    /**
     * @throws ReflectionException
     * @throws GuzzleException
     * @throws NoBodyTypeProvidedException
     */
    public function call($object, $method, $arguments): ResponseInterface
    {
        $reflectionClass = new ReflectionClass($object);
        $classAnnotations = $this->reader->getClassAnnotations($reflectionClass);
        $clientConfig = (new ConfigInterpreter($classAnnotations))->makeConfig();

        $this->client->setDefaultOptions(array_merge($this->client->getDefaultOptions(), $clientConfig));

        // handle class level middleware
        $middlewareInterpreter = new MiddlewareInterpreter($this->client);
        $this->client = $middlewareInterpreter->interpretMiddlewares($classAnnotations);

        $reflectionMethod = new ReflectionMethod($object, $method);
        $annotations = $this->reader->getMethodAnnotations($reflectionMethod);
        
        // handle method level middleware
        $this->client = $middlewareInterpreter->interpretMiddlewares($annotations);

        $methods = (new MethodInterpreter([$reflectionMethod], [$annotations], $arguments))
            ->makeMethods();

        /** @var RequestConfiguration $requestConfiguration */
        $requestConfiguration = $methods[$reflectionMethod->getName()];

        $path = $requestConfiguration->getAction()->getEndpoint();
        $requestOptions = $requestConfiguration->getRequestOptions();

        if (isset($requestOptions['query'])) {
            // Collect path param names (already converted to $varname form by Endpoint::getUri)
            preg_match_all('/\$([a-zA-Z0-9_]+)/', $path, $matches);
            $pathParamNames = $matches[1] ?? [];

            $path = $this->generateUrlFromTemplate($path, $requestOptions['query']);

            // Remove path params from query to avoid them being appended as query string
            foreach ($pathParamNames as $name) {
                unset($requestOptions['query'][$name]);
            }
            if (empty($requestOptions['query'])) {
                unset($requestOptions['query']);
            }
        }

        return $this->client->request(
            $path,
            $requestConfiguration->getAction()->getMethod(),
            $requestOptions);
    }

    /**
     * @param $template
     * @param $params
     * @return array|mixed|string|string[]
     * @author Hollis
     * @desc handle url params
     */
    function generateUrlFromTemplate($template, $params)
    {
        // iterate over params array, replace placeholder in url template
        foreach ($params as $key => $value) {
            if (is_array($value)) foreach ($value as $k => $v) {
                $template = str_replace('$' . $k, $v, $template);
            } else {
                $template = str_replace('$' . $key, $value, $template);
            }

        }

        return $template;
    }

    /**
     * set client options
     * @param array $options
     * @return void
     * @author Hollis
     */
    public function setDefaultOptions(array $options = [])
    {
        $this->client->setDefaultOptions(array_merge($this->client->getDefaultOptions(), $options));
    }
}
