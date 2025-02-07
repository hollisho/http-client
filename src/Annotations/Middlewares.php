<?php

namespace hollisho\httpclient\Annotations;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 */
class Middlewares extends Annotation
{

    /**
     * @var ConfigurationAnnotationInterface[]
     */
    public $middlewares;

    /**
     * @return ConfigurationAnnotationInterface[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * Returns the corresponding to guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string
    {
        return "";
    }
} 