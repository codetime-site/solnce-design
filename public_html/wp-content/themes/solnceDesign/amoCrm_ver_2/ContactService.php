<?php
// ContactService.php

class ContactService {
    private $client;

    public function __construct(AmoClient $client) {
        $this->client = $client;
    }

    public function createContact(ContactFormData $data) {
        $contactData = [
            [
                'name' => $data->name,
                'custom_fields_values' => []
            ]
        ];

        if (!empty($data->phone)) {
            $contactData[0]['custom_fields_values'][] = [
                'field_code' => 'PHONE',
                'values' => [['value' => $data->phone, 'enum_code' => 'WORK']]
            ];
        }

        if (!empty($data->email)) {
            $contactData[0]['custom_fields_values'][] = [
                'field_code' => 'EMAIL',
                'values' => [['value' => $data->email, 'enum_code' => 'WORK']]
            ];
        }

        $res = $this->client->post('/contacts', $contactData);
        $code = $res['code'];
        $body = $res['body'];

        if (!in_array($code, [200, 201])) {
            throw new Exception('Ошибка создания контакта: ' . $res['raw']);
        }

        $contact_id = $body['_embedded']['contacts'][0]['id'] ?? null;
        if (!$contact_id) {
            throw new Exception('Не удалось получить ID контакта: ' . $res['raw']);
        }

        return $contact_id;
    }
}

