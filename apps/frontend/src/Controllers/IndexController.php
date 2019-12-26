<?php

namespace Frontend\Controllers;

use Datto\JsonRpc\Http\Exceptions\HttpException;
use Datto\JsonRpc\Responses\ErrorResponse;
use Frontend\Controller;
use Frontend\Services\BackendClient;

class IndexController extends Controller
{

    public function indexAction(): void
    {

    }

    public function getShortUrlAction(): bool
    {

        if($this->request->isPost()) {

            $longUrl = $this->request->get('url');

            $client = new BackendClient();

            $client->urlReduce($longUrl, $shortUrl);

            try {

                $client->send();

                if ($shortUrl instanceof ErrorResponse) {

                    if ($shortUrl->getCode() === -32602) {

                        return $this->errorJson('Invalid URL', 2);

                    }

                    return $this->errorJson('Something went wrong', 1);

                }

                $domain = 'http://localhost:8080';

                return $this->successJson($domain . '/' . $shortUrl);

            } catch (HttpException $e) {

                // TODO: LOG THIS CASE

                return $this->errorJson('Something went wrong', 1);

            } catch (\ErrorException $e) {

                // TODO: LOG THIS CASE

                return $this->errorJson('Something went wrong', 1);
            }

        } else {

            return $this->errorJson();

        }
    }

}