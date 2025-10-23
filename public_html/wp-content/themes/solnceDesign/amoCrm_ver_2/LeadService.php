<?php
// LeadService.php

class LeadService {
    private $client;
    private $pipelineId;
    private $statusId;

    public function __construct(AmoClient $client, $pipelineId, $statusId) {
        $this->client = $client;
        $this->pipelineId = $pipelineId;
        $this->statusId = $statusId;
    }

    public function createLead(ContactFormData $data, $contactId) {
        $leadData = [
            [
                'name' => 'Новая сделка с сайта ' . $data->site_name,
                // 'price' => 1000,
                'status_id' => $this->statusId,
                'pipeline_id' => $this->pipelineId,
                'custom_fields_values' => [
                    // заменяй field_id на свои
                    [
                        'field_id' => 1800501, 
                        'values' => [['value' => $data->page_title]]
                    ],
                    [
                        'field_id' => 1800463,
                        'values' => [['value' => $data->phone]]
                    ],
                    [
                        'field_id' => 1800461,
                        'values' => [['value' => $data->name]]
                    ],
                    [
                        'field_id' => 1800465,
                        'values' => [['value' => $data->address]]
                    ],
                ],
                '_embedded' => [
                    'contacts' => [
                        ['id' => (int)$contactId]
                    ]
                ]
            ]
        ];

        $res = $this->client->post('/leads', $leadData);
        $code = $res['code'];

        if (!in_array($code, [200, 201])) {
            throw new Exception('Ошибка создания сделки: ' . $res['raw']);
        }

        return true;
    }
}

