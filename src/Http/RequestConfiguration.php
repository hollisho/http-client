<?php

namespace hollisho\httpclient\Http;

use hollisho\httpclient\Annotations\Action;

/**
 * Represents the configuration for an HTTP request
 */
class RequestConfiguration
{
    /** @var Action */
    private $action;

    /** @var array */
    private $requestOptions;

    /**
     * @param Action $action
     * @param array $requestOptions
     */
    public function __construct(Action $action, array $requestOptions)
    {
        $this->action = $action;
        $this->requestOptions = $requestOptions;
    }

    /**
     * Creates a new instance from an array of data
     * 
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['action'] ?? null,
            $data['requestOptions'] ?? []
        );
    }

    /**
     * @return Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getRequestOptions(): array
    {
        return $this->requestOptions;
    }
} 