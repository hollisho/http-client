<?php

namespace hollisho\httpclient\Interpreters;

use hollisho\httpclient\Annotations\Action;
use hollisho\httpclient\Annotations\Method\Post;
use hollisho\httpclient\Annotations\Request\Headers;
use hollisho\httpclient\Constants\BodyConstants;
use hollisho\httpclient\Constants\ConfigurationConstants;
use hollisho\httpclient\Constants\MethodConstants;
use hollisho\httpclient\Exceptions\NoBodyTypeProvidedException;
use hollisho\httpclient\Http\RequestConfiguration;
use ReflectionMethod;
use ReflectionParameter;

class MethodInterpreter
{
    /**
     * @var ReflectionMethod[]
     */
    private $reflectionMethods = [];

    /**
     * @var array
     */
    private $annotations = [];

    /**
     * @var array
     */
    private $arguments = [];

    /**
     * MethodFactory constructor.
     *
     * @param array $methods
     * @param array $annotations
     * @param array $arguments
     */
    public function __construct(
        array $methods,
        array $annotations,
        array $arguments
    ) {
        $this->reflectionMethods = $methods;
        $this->annotations = $annotations;
        $this->arguments = $arguments;
    }

    /**
     * @throws NoBodyTypeProvidedException
     */
    public function makeMethods(): array
    {
        $methods = [];
        foreach ($this->reflectionMethods as $key => $reflectionMethod) {
            $requestOptions = [];
            $requestBody = [];
            $requestHeaders = [];
            $params = [];

            if ($reflectionMethod->getParameters()) {
                $params = $this->buildParameters($reflectionMethod->getParameters());
            }

            /** @var Action $action */
            $action = array_reduce($this->annotations[$key], function ($carry, $annotation) {
                return ($annotation instanceof Action) ? $annotation : $carry;
            });

            if ($action !== null) {
                if ($action->getMethod() == MethodConstants::HTTP_POST) {
                    $requestBody = $this->buildRequestBody($action, $params);
                } else {
                    $requestOptions['query'] = $params;
                }
            }

            /** @var Headers $headers */
            $headers = array_reduce($this->annotations[$key], function ($carry, $annotation) {
                return ($annotation instanceof Headers) ? $annotation : $carry;
            });

            if ($headers !== null) {
                $requestHeaders = $this->buildRequestHeaders($headers);
            }

            $requestOptions = array_merge(
                $requestOptions,
                $requestBody,
                $requestHeaders
            );

            $methods[$reflectionMethod->getName()] = RequestConfiguration::fromArray([
                'action' => $action,
                'requestOptions' => $requestOptions
            ]);

        }

        return $methods;
    }

    /**
     * @param array $reflectionParameters
     * @return array
     * @author Hollis
     * @desc
     */
    private function buildParameters(array $reflectionParameters): array
    {
        $params = [];
        /**
         * @var ReflectionParameter $parameter
         */
        foreach ($reflectionParameters as $key => $parameter) {
            $params[$parameter->getName()] = $this->arguments[$key];
        }

        return $params;
    }

    /**
     * Builds the request body from the action.
     *
     * @param Action $action
     * @param array $requestParams
     *
     * @return array
     *
     * @throws NoBodyTypeProvidedException
     */
    private function buildRequestBody(Action $action, array $requestParams): array
    {
        if (!$action->hasBody()) {
            return [];
        }

        $value = isset($requestParams[$action->getBodyParamName()]) ? $requestParams[$action->getBodyParamName()] : null;

        switch ($action->getBodyType()) {
            case BodyConstants::JSON_BODY :
                $requestOptions['json'] = $value;
                break;
            case BodyConstants::MULTI_PART_BODY :
                $requestOptions['multipart'] = $value;
                break;
            case BodyConstants::FORM_PARAMS_BODY :
                $requestOptions['form_params'] = $value;
                break;
        }

        return $requestOptions ?? [];
    }

    /**
     * Builds the array of request headers.
     *
     * @param Headers $headers
     *
     * @return array
     */
    private function buildRequestHeaders(Headers $headers): array
    {
        $headerBag = [];

        foreach ($headers->getHeaders() as $header) {
            if ($header instanceof Headers\AuthBasic) {
                $headerBag['Authorization'] = 'Basic ' . base64_encode(implode(':', $header->getValue()));
                continue;
            }

            $headerBag = array_merge($header->getValue(), $headerBag);
        }

        return [ConfigurationConstants::HEADER_CONFIG_KEY => $headerBag];
    }
}
