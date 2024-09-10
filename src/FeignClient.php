<?php

namespace hollisho\httpclient;

use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Exception\GuzzleException;
use hollisho\httpclient\Annotations\Method\Get;
use hollisho\httpclient\Annotations\Method\Post;

/**
 * @author Hollis
 * @desc
 * Class FeignClient
 * @package hollisho\httpclient
 */
class FeignClient extends BaseClient
{
    protected $baseUri;

    private $reader;

    public function __construct(string $baseUri)
    {
        parent::__construct($baseUri);
        $this->reader = new AnnotationReader();
    }

    /**
     * @throws \ReflectionException
     * @throws GuzzleException
     */
    public function call($object, $method, $arguments)
    {
        $reflectionMethod = new \ReflectionMethod($object, $method);
        $annotations = $this->reader->getMethodAnnotations($reflectionMethod);
        var_dump($annotations);exit;

        foreach ($annotations as $annotation) {
            if ($annotation instanceof Get) {
                $path = $this->resolvePath($annotation->path, $arguments);
                $response = $this->httpGet($path);
                return $response->getBody();
            } elseif ($annotation instanceof Post) {
                $path = $annotation->path;
                $response = $this->httpPost($path, [
                    'json' => $arguments[0],
                ]);
                return $response->getBody();
            }
        }

        throw new \Exception("No annotation found for method $method");
    }

    private function resolvePath($path, $arguments)
    {
        // 替换路径中的占位符
        return preg_replace_callback('/\{(\w+)\}/', function ($matches) use ($arguments) {
            return $arguments[0];
        }, $path);
    }
}