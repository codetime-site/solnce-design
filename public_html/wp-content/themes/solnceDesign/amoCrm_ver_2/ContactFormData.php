<?php
// ContactFormData.php

class ContactFormData {
    // public $allowed_form_id;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $site_name;
    public $page_title;

    public static function fromContactForm($contact_form) {
        $allowed_form_id = 337;
        $form_id = method_exists($contact_form, 'id') ? $contact_form->id() : null;
        if ($form_id != $allowed_form_id) {
            throw new Exception('Не тот ID формы (или форма не разрешена)');
        }

        $submission = WPCF7_Submission::get_instance();
        if (!$submission) {
            throw new Exception('CF7 submission не найден');
        }

        $data = $submission->get_posted_data();

        $obj = new self();
        $obj->name = sanitize_text_field($data['names'] ?? 'Без имени');
        $obj->phone = sanitize_text_field($data['phones'] ?? '');
        $obj->email = sanitize_email($data['email'] ?? ($data['emails'] ?? ''));
        $obj->address = sanitize_text_field($data['city'] ?? 'Не указан город');
        $obj->page_title = sanitize_text_field($data['acf_title'] ?? 'footer form in main page');
        $obj->site_name = get_bloginfo('name');
        // $titles = get_query_var( 'acf_title');
        // $obj->page_title = $titles ?: 'footer form in main page';

        return $obj;
    }
}

