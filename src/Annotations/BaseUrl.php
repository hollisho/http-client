<?php

namespace hollisho\httpclient\Annotations;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;
use hollisho\httpclient\Constants\ConfigurationConstants;

/**
 * Class BaseUrl
 *
 * @Annotation
 * @Annotation\Target({"CLASS"})
 *
 * @package hollisho\httpclient\Annotations
 */
class BaseUrl extends Annotation implements ConfigurationAnnotationInterface
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $host;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->host;
    }

    /**
     * Returns the corresponding guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string
    {
        return ConfigurationConstants::BASE_URI_CONFIG_KEY;
    }
}