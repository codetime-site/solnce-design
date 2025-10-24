<?php
// PHP-логика (Предполагается, что она находится внутри цикла ACF: while(have_rows(...)): the_row();)
$layout = get_row_layout();
$title = get_sub_field('title');
if ($layout) {
    // Внимание: переменная $repeater здесь нигде не используется, но логика верна.
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

<?php if ($layout === "hero" && $btn):?>
    <button class="btn btn_sec openModalBtn" id="openModalBtn">
        <?php echo esc_html($btn) ?>
        <i class="fontello-arrows-right-line1"></i>
    </button>
<?php endif; ?>


<?php/* if ($layout === "service"):?>
    <h1>helllllo</h1>
    <button type="button" class="win__link toggle-form" id="openModalBtn"><?php echo esc_html($btn); ?></button>
<?php endif; */?>



