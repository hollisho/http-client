<?php
namespace hollisho\httpclient\Annotations;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Method\Contracts\MethodAnnotationInterface;
use hollisho\httpclient\Annotations\Request\Body;
use hollisho\httpclient\Annotations\Request\Endpoint;
use hollisho\httpclient\Exceptions\NoBodyTypeProvidedException;

/**
 * Class Action
 *
 * @Annotation
 * @Annotation\Target({"METHOD"})
 *
 * @package hollisho\httpclient\Annotations
 */
class Action extends Annotation
{
    /**
     * @var MethodAnnotationInterface
     */
    public $method;

    /**
     * @var Endpoint
     */
    public $endpoint;

    /**
     * @var Body
     */
    public $body;

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method->getHttpMethod();
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint->getUri();
    }

    /**
     * @return bool
     */
    public function hasBody(): bool
    {
        return $this->body !== null;
    }

    /**
     * @return string
     *
     * @throws NoBodyTypeProvidedException
     */
    public function getBodyType(): string
    {
        return $this->body->getBodyType();
    }

    /**
     * @return string
     */
    public function getBodyParamName(): string
    {
        return $this->body->getName();
    }
}