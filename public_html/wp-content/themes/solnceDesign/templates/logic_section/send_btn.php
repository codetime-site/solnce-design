<?php
$layout = get_row_layout();
if ($layout) {
    switch ($layout) {
        case 'video':
            $repeater = 'rep_video';
            break;
        case 'worker':
            $repeater = 'rep_wokr';
            break;
        case 'reviews':
            $repeater = 'rep_win';
            break;
        case 'contact':
            $repeater = 'rep_adress';
            break;
        default:
            $repeater = 'rep_step';
            break;
    }
}

$btn = get_sub_field('btn');
?>

<?php //if ($layout && $layout == "hero"): ?>
<?php if ($btn): ?>
        <button onclick="window.location.href = '#form'" class=" btn btn_sec">
            <?php echo esc_html($btn) ?>
            <i class="fontello-arrows-right-line1"></i>
        </button>
<?php endif; ?>
<? php// endif; ?>