<?php

namespace hollisho\httpclient\Annotations\Request;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Endpoint
 *
 * @Annotation
 * @Annotation\Target({"METHOD"})
 *
 * @package hollisho\httpclient\Annotations\Request
 */
class Endpoint extends Annotation
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $uri;

    /**
     * @return string
     */
    public function getUri(): string
    {
        // Replace placeholders with proper variables for method body.
        return preg_replace('/({)([a-zA-Z1-9]*)(})/', '$' . '$2', $this->uri);
    }
}