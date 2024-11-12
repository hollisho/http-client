<?php

namespace hollisho\httpclient;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class BaseClient
{
    use HasHttpRequests;

    /**
     * @var string
     */
    protected $baseUri;

    protected $guzzleHandler;

    /**
     * BaseClient constructor.
     * @param string|null $baseUri
     */
    public function __construct(string $baseUri = null)
    {
        $this->baseUri = $baseUri;
    }


    /**
     * GET request.
     * @param string $url
     * @param array $query
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function httpGet(string $url, array $query = [])
    {
        return $this->request($url, 'GET', [RequestOptions::QUERY => $query]);
    }

    /**
     * POST request.
     * @param string $url
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function httpPost(string $url, array $data = [])
    {
        return $this->request($url, 'POST', [RequestOptions::FORM_PARAMS => $data]);
    }

    /**
     * JSON request.
     * @param string $url
     * @param array $data
     * @param array $query
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function httpPostJson(string $url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', [RequestOptions::QUERY => $query, RequestOptions::JSON => $data]);
    }

    /**
     * Upload file.
     * @param string $url
     * @param array $files
     * @param array $form
     * @param array $query
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function httpUpload(string $url, array $files = [], array $form = [], array $query = [])
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name' => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request($url, 'POST', [
            RequestOptions::QUERY => $query,
            RequestOptions::MULTIPART => $multipart,
            RequestOptions::CONNECT_TIMEOUT => 30,
            RequestOptions::TIMEOUT => 30,
            RequestOptions::READ_TIMEOUT => 30
        ]);
    }
}
