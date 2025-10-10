<?php
$repeter = "rep_port";
$galary = [];
$btns = [];
$count = 0;

if (have_rows($repeter)) {
    while (have_rows($repeter)) { the_row();
        $btn_name = get_sub_field('btn_name');
        $images = get_sub_field('galary');
        $slug = translit($btn_name); // латиница для data-filter

        if (!empty($btn_name) && !empty($images)) {
            $btns[] = [
                'name' => $btn_name,
                'slug' => $slug
            ];
            $galary[$slug] = $images;
        }
    }
}
?>
<section class="portfolio section">
    <div class="container">
        <?php get_template_part(GET_ACF_TITLE); ?>
        <div class="block_padding_60"></div>

        <?php //Кнопки фильтра ?>
        <div class="works-filter">
            <?php foreach ($btns as $index => $btn): ?>
                <button class=" btn_win filter-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                    data-filter="<?php echo esc_attr($btn['slug']); ?>">
                    <?php echo esc_html($btn['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="block_padding_40"></div>

        <?php //Галерея ?>
        <div class="works-gallery">
            <?php
            $first_slug = $btns[0]['slug'] ?? ''; // первый слаг
            foreach ($galary as $slug => $images):
                ?>
                <?php foreach ($images as $img): ?>
                    <div class="work-item" data-category="<?php echo esc_attr($slug); ?>"
                        style="<?php echo ($slug !== $first_slug) ? 'display:none;' : ''; ?>">
                        <div class="work-image">
                            <img src="<?php echo esc_url($img); ?>" alt="">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

    </div>
</section>