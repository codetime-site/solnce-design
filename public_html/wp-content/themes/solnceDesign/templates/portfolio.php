<?php
$repeter = "rep_port";
$galary = [];
$btns = [];
$count = 0;

if (have_rows($repeter)) {
    while (have_rows($repeter)) {
        the_row();
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

// Функция транслитерации
function translit($str)
{
    $arr = array(
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shch',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'E',
        'Ж' => 'Zh',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'Y',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'Ts',
        'Ч' => 'Ch',
        'Ш' => 'Sh',
        'Щ' => 'Shch',
        'Ъ' => '',
        'Ы' => 'Y',
        'Ь' => '',
        'Э' => 'E',
        'Ю' => 'Yu',
        'Я' => 'Ya'
    );
    $str = strtr($str, $arr);
    $str = str_replace(' ', '_', $str);
    return mb_strtolower($str, 'UTF-8');
}
?>

<section class="portfolio section">
    <div class="container">
        <?php get_template_part(GET_ACF_TITLE); ?>
        <div class="block_padding_60"></div>

        <!-- Кнопки фильтра -->
        <!-- Кнопки фильтра -->
        <div class="works-filter">
            <?php foreach ($btns as $index => $btn): ?>
                <button class="filter-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                    data-filter="<?php echo esc_attr($btn['slug']); ?>">
                    <?php echo esc_html($btn['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="block_padding_40"></div>

        <!-- Галерея -->
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const workItems = document.querySelectorAll('.work-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Сброс активного состояния
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.dataset.filter;

                workItems.forEach(item => {
                    if (filterValue == 'all' || item.dataset.category === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>