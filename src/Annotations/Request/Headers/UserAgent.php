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
class UserAgent extends Annotation implements ConfigurationAnnotationInterface
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $agent;

    /**
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * Returns the value that the configuration holds.
     *
     * @return mixed
     */
    public function getValue()
    {
        return [
            'User-Agent' => $this->getAgent(),
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