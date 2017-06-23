<?php

namespace MotaMonteiro\Helpers;


class ApiHelper
{
    const CONTENT_TYPE_JSON = 'Content-Type: application/json';

    /**
     * @var string
     */
    private $baseUrl;
    /**
     * @var string
     */
    private $tokenKey;
    /**
     * @var ErrorHelper
     */
    private $errorHelper;

    /**
     * ApiHelper constructor.
     * @param string $baseUrl
     * @param string $tokenKey
     */
    public function __construct($baseUrl = '', $tokenKey = '')
    {
        $this->baseUrl = $baseUrl;
        $this->tokenKey = $tokenKey;
        $this->errorHelper = new ErrorHelper();
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getTokenKey(): string
    {
        return $this->tokenKey;
    }

    /**
     * @param string $tokenKey
     */
    public function setTokenKey(string $tokenKey)
    {
        $this->tokenKey = $tokenKey;
    }

    /**
     * @param $url
     * @param string $method
     * @param array $data
     * @param string $tokenValue
     * @return ErrorHelper|array
     */
    public function request($url, $method = 'GET', array $data = [], $tokenValue = '')
    {
        $headerAuth = ($tokenValue != '') ? $this->tokenKey . " : " . $tokenValue : '';
        $headerPost = ($headerAuth != '') ? self::CONTENT_TYPE_JSON : '';
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array($headerAuth, $headerPost));
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_HTTPHEADER, array($headerAuth, $headerPost));
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            default:
                curl_setopt($curl, CURLOPT_HTTPHEADER, array($headerPost, $headerAuth));
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }

        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $dataCurl = curl_exec($curl);
        $header_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $json = $this->getJson($header_code, $dataCurl);

        if ($this->existsRequestError()) {
            return $this->errorHelper;
        }

        return ['header_code' => $header_code, 'json' => $json];

    }

    /**
     * @return bool
     */
    public function existsRequestError()
    {
        return ($this->errorHelper->existsErrorHelper());
    }

    /**
     * @return array
     */
    public function getRequestErrorArray()
    {
        return $this->errorHelper->getArrayErrorHelper();
    }

    /**
     * @param $headerCode
     * @param $dataCurl
     * @return mixed|ErrorHelper
     */
    private function getJson($headerCode, $dataCurl)
    {
        $this->validateHeader($headerCode);
        if ($this->errorHelper->existsErrorHelper()) {
            return $this->errorHelper;
        }

        $json = json_decode($dataCurl, true);

        $this->validateJson();
        if ($this->errorHelper->existsErrorHelper()) {
            return $this->errorHelper;
        }

        return $json;
    }

    /**
     * @param $headerCode
     */
    private function validateHeader($headerCode)
    {
        if ($headerCode == 0) {
            $this->errorHelper->addMessage('server_error_header_0')->setStatusCode('500');
        }
    }

    private function validateJson()
    {
        if (json_last_error() != JSON_ERROR_NONE) {
            $this->errorHelper->addMessage('server_error_converting_to_json')->setStatusCode('400');
        }
    }
}