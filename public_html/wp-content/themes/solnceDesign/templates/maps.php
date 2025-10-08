<?php
$map1 = get_sub_field('maps_1');
$map2 = get_sub_field('maps_2');
?>
<section class="section maps">
    <div class="container">
        <div class="maps__content">
            <?php get_template_part('templates/logic_section/send_title'); ?>
            <div class="block_padding_40"></div>
            <div class="maps__btm grid_block_two">
                <?php if ($map1): ?>
                    <div class="maps__left" id="map1"></div>
                <?php endif; ?>
                <?php if ($map2): ?>
                    <div class="maps__right" id="map2"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    const mapUrl1 = <?php echo json_encode($map1); ?>;
    const mapUrl2 = <?php echo json_encode($map2); ?>;
</script>
