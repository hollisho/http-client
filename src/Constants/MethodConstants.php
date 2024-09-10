<?php
namespace hollisho\httpclient\Constants;

/**
 * @author Hollis
 * @desc
 * Class MethodConstants
 * @package hollisho\httpclient\Constants
 */
final class MethodConstants
{
    /**
     * These are the allowed HTTP methods for the annotations.
     *
     * @const string
     */
    const HTTP_POST = 'POST';
    const HTTP_GET = 'GET';
    const HTTP_DELETE = 'DELETE';
    const HTTP_PUT = 'PUT';
    const HTTP_PATCH = 'PATCH';
    const HTTP_OPTIONS = 'OPTIONS';
}