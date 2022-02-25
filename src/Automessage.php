<?php

namespace Nyx\Automessage;

class Automessage {

    private static $curl;
    public static $endpoint;

    public static function sendEvent($data) {
        self::init();

        if (!self::testCurl())
            return 'CurlConnectionController: Failed to initialize curl.';

        curl_setopt(self::$curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec(self::$curl);

        return FALSE === $result ? 'CurlConnectionController: Failed to send event.' : $result;
    }

    private static function init() {
        self::$curl = curl_init();
        self::curlOptions();
    }

    private static function curlOptions() {
        curl_setopt_array(self::$curl,
            [
                CURLOPT_URL => self::$endpoint,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_TIMEOUT => 100,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POST => true
            ]
        );
    }

    private static function testCurl() : bool {
        return !(FALSE === self::$curl);
    }
}
