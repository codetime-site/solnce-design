<?php if (settinfPage('tel')): ?>
    <a href="tel:<?php echo esc_html(settinfPage('tel')); ?>" class="social-link phone" target="_blank">
        <i class="fontello-phone-call"></i>
        <p>
            <?php echo esc_html(settinfPage('tel')); ?>
        </p>
    </a>
<?php endif; ?>