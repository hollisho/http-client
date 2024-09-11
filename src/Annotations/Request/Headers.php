<?php

namespace hollisho\httpclient\Annotations\Request;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;

/**
 * Class Header
 *
 * @Annotation
 * @Annotation\Target({"METHOD"})
 *
 * @package hollisho\httpclient\Annotations\Request
 */
class Headers extends Annotation
{
    /**
     * @var ConfigurationAnnotationInterface[]
     */
    public $headers;

    /**
     * @return ConfigurationAnnotationInterface[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}