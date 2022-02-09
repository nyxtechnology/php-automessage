<?php

namespace Nyx\Automessage;

class CurlConnectionController
{
    private $curl;
    private $config;

    public function __construct() {
        $this->config = json_decode(file_get_contents(__DIR__ . '/config.json'));
        $this->curl = curl_init();
        $this->curlOptions();
    }

    /**
     * @return bool
     */
    private function testCurl() : bool {
        return !(FALSE === $this->curl);
    }

    /**
     * @throws Exception
     */
    public function sendEvent($data) : string {
        if (!$this->testCurl())
            return 'CurlConnectionController: Failed to initialize curl.';

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($this->curl);

        return FALSE === $result ? 'CurlConnectionController: Failed to send event.' : $result;
    }

    public function curlOptions()
    {
        curl_setopt_array($this->curl,
            [
                CURLOPT_URL => $this->config->apiEndpoint,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_TIMEOUT => 100,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POST => true
            ]
        );
    }
}
