<?php $rec = get_sub_field('rec'); ?>

<?php if ($rec): ?>
    <div class="min_rec grid_block">
        <p class="subs"><?php echo esc_html($rec); ?></p>
    </div>
<?php endif; ?>