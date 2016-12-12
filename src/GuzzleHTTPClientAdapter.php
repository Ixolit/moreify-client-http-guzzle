<?php

namespace Ixolit\Moreify\HTTP\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Ixolit\Moreify\Interfaces\HTTPClientAdapter;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class GuzzleHTTPClientAdapter implements HTTPClientAdapter {
    private $client;

    public function __construct() {
        $this->client = new Client();
    }

    /**
     * @return RequestInterface
     */
    public function createRequest() {
        return new Request('GET', '/');
    }

    /**
     * @return UriInterface
     */
    public function createUri() {
        return new Uri();
    }

    /**
     * @param string $string
     *
     * @return StreamInterface
     */
    public function createStringStream($string) {
        return \GuzzleHttp\Psr7\stream_for($string);
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function send(RequestInterface $request) {
        try {
            return $this->client->send($request);
        } catch (ClientException $e) {
            return $e->getResponse();
        }
    }
}
