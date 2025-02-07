<?php

namespace hollisho\httpclient\Interpreters;

use hollisho\httpclient\BaseClient;
use hollisho\httpclient\Annotations\Middleware;
use hollisho\httpclient\Annotations\Middlewares;

class MiddlewareInterpreter
{
    /**
     * @var BaseClient
     */
    private $client;

    public function __construct(BaseClient $client)
    {
        $this->client = $client;
    }

    /**
     * handle middleware annotations
     * @param array $annotations
     * @return BaseClient
     */
    public function interpretMiddlewares(array $annotations): BaseClient
    {
        foreach ($annotations as $annotation) {
            if ($annotation instanceof Middlewares) {
                foreach ($annotation->getMiddlewares() as $middleware) {
                    if ($middleware instanceof Middleware) {
                        $this->addMiddleware($middleware->value);
                    }
                }
            } elseif ($annotation instanceof Middleware) {
                $this->addMiddleware($annotation->value);
            }
        }

        return $this->client;
    }

    /**
     * add middleware
     * @param string $middlewareClass
     * @return void
     */
    private function addMiddleware(string $middlewareClass)
    {
        if (class_exists($middlewareClass)) {
            $middleware = new $middlewareClass();
            $this->client->pushMiddleware($middleware);
        }
    }
} 