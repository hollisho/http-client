<?php
namespace hollisho\httpclient\Annotations\Request\Contracts;

/**
 * Interface ConfigurationAnnotationInterface
 *
 * This is the contract that all configuration based annotations implement.
 *
 * @package hollisho\httpclient\Annotations\Request\Contracts
 */
interface ConfigurationAnnotationInterface
{
    /**
     * Returns the value that the configuration holds.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Returns the corresponding guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string;
}