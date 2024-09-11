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
class ContentType extends Annotation implements ConfigurationAnnotationInterface
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Returns the value that the configuration holds.
     *
     * @return mixed
     */
    public function getValue()
    {
        return [
            'Content-Type' => $this->getType(),
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