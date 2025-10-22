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

<?php if ($layout && $layout == "hero"): ?>
<?php if ($btn): ?>
        <button onclick="window.location.href = '#form'" class="btn btn_sec win__link ">
            <?php echo esc_html($btn) ?>
            <i class="fontello-arrows-right-line1"></i>
        </button>
<?php endif; ?>
<?php endif; ?>

<?php  get_template_part('templates/logic_section/openForms');?>

 <script>

    // document.querySelectorAll(".win").forEach(function (item) {
        const link = document.querySelector(".win__link"); // Находим .win__link внутри текущего .win__img

        // Show modal on button click
        if (link) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const modal = document.getElementById('service-modal');
                modal.style.display = 'flex';
            });
        }
    // });

    // Close modal
    document.getElementById('close-modal').addEventListener('click', function () {
        document.getElementById('service-modal').style.display = 'none';
    });

    // Close modal on outside click
    document.getElementById('service-modal').addEventListener('click', function (e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script> 