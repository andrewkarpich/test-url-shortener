<?php

namespace Frontend\Services;


use Datto\JsonRpc\Http\Client;

class BackendClient extends Client
{

    public function __construct(array $headers = null, array $options = null)
    {

        parent::__construct('http://nginx_backend:8080', $headers, $options);

    }

    public function urlReduce($longUrl, &$result): void
    {

        $this->query('url_reduce', [$longUrl], $result);

    }

}