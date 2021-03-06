<?php

namespace Backend\Controllers;


use Backend\Models\Url;
use Backend\Phalcon\JsonRpcController;
use Datto\JsonRpc\Exceptions\ApplicationException;
use Datto\JsonRpc\Exceptions\ArgumentException;
use Phalcon\Filter;
use Phalcon\Security\Exception;
use Phalcon\Validation;

class UrlController extends JsonRpcController {

    /**
     * @param string $longUrl
     * @return string
     * @throws ApplicationException
     * @throws ArgumentException
     * @throws Exception
     */
    public function reduceAction(string $longUrl): string {

        $longUrl = (new Filter)->sanitize($longUrl, ['string', 'trim']);

        $validation = new Validation();

        $validation->add('url', new \Phalcon\Validation\Validator\Url);

        if (!$validation->validate(['url' => $longUrl]) || !filter_var($longUrl, FILTER_VALIDATE_URL)) {
            throw new ArgumentException();
        }

        /**
         * @var Url $url
         */
        $url = Url::findFirstByUrl($longUrl);

        if ($url) return $url->code;

        $url = new Url();

        $url->url = $longUrl;


        $url->code = $this->generateCode();

        if ($url->code !== null && $url->save()) {

            return $url->code;

        }

        // TODO: LOG THIS CASE

        throw new ApplicationException('Something went wrong!', 1);

    }

    /**
     * @param int $nestedLevel
     * @return string
     * @throws ApplicationException
     */
    protected function generateCode(int $nestedLevel = 1): ?string {

        try {

            if ($nestedLevel < 5) {

                $code = mb_substr($this->security->getRandom()->base64Safe(10), -10 - ($nestedLevel - 1), -5);

                if (Url::countByCode($code) > 0) {

                    return $this->generateCode($nestedLevel + 1);

                }

                return $code;

            }

            return null;

        } catch (Exception $e) {

            // TODO: LOG THIS CASE

            throw new ApplicationException('Something went wrong!', 1);

        }

    }
}