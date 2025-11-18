<?php 


add_action('wp_ajax_upload_canvas', 'upload_canvas');
add_action('wp_ajax_nopriv_upload_canvas', 'upload_canvas');

function upload_canvas()
{
    if (empty($_FILES['canvas_image']))
        wp_send_json_error('No file');

    $file = $_FILES['canvas_image'];
    $upload = wp_handle_upload($file, ['test_form' => false]);

    if (isset($upload['url'])) {
        wp_send_json_success(['url' => $upload['url']]);
    } else {
        wp_send_json_error('Upload failed');
    }
}
