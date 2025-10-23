<?php
// AmoConfig.php

class AmoConfig {
    private $subdomain;
    private $access_token;
    private $pipeline_id;
    private $status_id;

    public function __construct($pipeline_id = 6967578, $status_id = 58548442) {
        // Параметры — отредактируй по необходимости
        $this->subdomain = 'shadoof';        
        $this->pipeline_id = $pipeline_id;
        $this->status_id = $status_id;

        $tokensFile = '/var/www/fastuser/data/www/solnce-design.ru/public_html/amocrm_tokens.json';
        if (!file_exists($tokensFile)) {
            throw new Exception('Файл токенов не найден: ' . $tokensFile);
        }

        $tokens = json_decode(file_get_contents($tokensFile), true);
        if (empty($tokens['access_token'])) {
            throw new Exception('access_token отсутствует в файле токенов');
        }
        $this->access_token = $tokens['access_token'];
    }

    public function getSubdomain() {
        return $this->subdomain;
    }

    public function getAccessToken() {
        return $this->access_token;
    }

    public function getPipelineId() {
        return $this->pipeline_id;
    }

    public function getStatusId() {
        return $this->status_id;
    }
}

