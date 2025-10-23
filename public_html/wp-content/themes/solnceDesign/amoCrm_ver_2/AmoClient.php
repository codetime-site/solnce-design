<?php
// AmoClient.php

class AmoClient {
    private $baseUrl;
    private $accessToken;

    public function __construct($subdomain, $accessToken) {
        $this->baseUrl = "https://{$subdomain}.amocrm.ru/api/v4";
        $this->accessToken = $accessToken;
    }

    private function request($method, $path, $body = null) {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($path, '/');

        $args = [
            'method'      => strtoupper($method),
            'headers'     => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type'  => 'application/json',
            ],
            'timeout'     => 30,
        ];

        if (!is_null($body)) {
            $args['body'] = wp_json_encode($body);
        }

        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            throw new Exception('HTTP error: ' . $response->get_error_message());
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        return ['code' => $code, 'body' => $data, 'raw' => $body];
    }

    public function post($path, $body) {
        return $this->request('POST', $path, $body);
    }
}

