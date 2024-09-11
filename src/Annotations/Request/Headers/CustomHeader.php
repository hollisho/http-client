<?php

namespace hollisho\httpclient\Annotations\Request\Headers;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;
use hollisho\httpclient\Constants\ConfigurationConstants;

/**
 * Class CustomHeader
 *
 * @Annotation
 * @Annotation\Target({"METHOD", "CLASS"})
 *
 * @package hollisho\httpclient\Annotations\Request\Headers
 */
class CustomHeader extends Annotation implements ConfigurationAnnotationInterface
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $name;

    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $body;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Returns the value that the configuration holds.
     *
     * @return mixed
     */
    public function getValue()
    {
        return [
            $this->getName() => $this->getBody(),
        ];
    }

    /**
     * Returns the corresponding guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string
    {
        return ConfigurationConstants::HEADER_CONFIG_KEY;
    }
}