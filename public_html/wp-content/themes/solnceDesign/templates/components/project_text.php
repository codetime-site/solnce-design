<?php var_dump($args) ?>
<?php if (!empty($args) && is_array($args)): ?>
    <?php foreach ($args as $text): ?>
        <?php foreach ($text as $key => $value): ?>
            <?php if ($key === 'title'): ?>
                <p class="subs_bold"> <?php echo esc_html($value); ?></p>
            <?php endif; ?>
            <?php if ($key === "sub_title"): ?>
                <p class="subs"> <?php echo esc_html($value); ?></p>
            <?php endif; ?>
            <?php if ($key === "title_project"): ?>
                <p class="subs_bold"> <?php echo esc_html($value); ?></p>
            <?php endif; ?>
            <?php if ($key === "sub_project"): ?>
                <p class="subs"> <?php echo esc_html($value); ?></p>
            <?php endif; ?>
            <?php if ($key === "price_title"): ?>
                <p class="subs_bold"> <?php echo esc_html($value); ?></p>
            <?php endif; ?>
            <?php if ($key === "price_sub"): ?>
                <p class="subs"> <?php echo esc_html($value); ?></p>
            <?php endif; ?>
            <?php if ($key === "btn"): ?>
                <div class="win_btm">
                    <button class="btn_win btn"><?php echo esc_html($btn); ?></button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endif; ?>