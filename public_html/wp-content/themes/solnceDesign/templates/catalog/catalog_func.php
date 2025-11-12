<?php

function get_child_categories($parent_slug, $taxonomy = 'category')
{
    $parent_category = get_term_by('slug', $parent_slug, $taxonomy);
    if (!$parent_category) {
        return [];
    }

    $child_categories = get_terms(array(
        'taxonomy' => $taxonomy,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
        'parent' => $parent_category->term_id
    ));

    $options = [];
    if (!is_wp_error($child_categories)) {
        foreach ($child_categories as $category) {
            $options[$category->slug] = $category->name;
        }
    }

    return $options;
}


// Получаем опции фильтров из WordPress категорий
// Примеры использования:
// Для стандартных категорий WordPress:
$color_options = get_child_categories('col');
$style_options = get_child_categories('style');
$material_options = get_child_categories('materials');

// Функция для получения дочерних терминов из произвольной таксономии
function get_child_terms($parent_slug, $taxonomy = 'category')
{
    $parent_term = get_term_by('slug', $parent_slug, $taxonomy);
    if (!$parent_term) {
        return [];
    }
    $child_terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
        'parent' => $parent_term->term_id
    ));
    $options = [];
    if (!is_wp_error($child_terms)) {
        foreach ($child_terms as $term) {
            $options[$term->slug] = $term->name;
        }
    }
    return $options;
}

// Если категории не найдены, используем fallback значения
if (empty($color_options)) {
    $color_options = [
        'белый' => 'Белый',
        'черный' => 'Черный',
        'серый' => 'Серый',
        'коричневый' => 'Коричневый',
        'бежевый' => 'Бежевый',
        'красный' => 'Красный',
        'синий' => 'Синий',
        'зеленый' => 'Зеленый',
        'желтый' => 'Желтый',
        'фиолетовый' => 'Фиолетовый',
        'оранжевый' => 'Оранжевый',
        'розовый' => 'Розовый',
        'золотой' => 'Золотой',
        'серебряный' => 'Серебряный',
        'другой' => 'Другой'
    ];
}

if (empty($style_options)) {
    $style_options = [
        'классический' => 'Классический',
        'современный' => 'Современный',
        'минимализм' => 'Минимализм',
        'лофт' => 'Лофт',
        'скандинавский' => 'Скандинавский',
        'прованс' => 'Прованс',
        'кантри' => 'Кантри',
        'винтаж' => 'Винтаж',
        'арт-деко' => 'Арт-деко',
        'хай-тек' => 'Хай-тек',
        'эко' => 'Эко',
        'индустриальный' => 'Индустриальный',
        'барокко' => 'Барокко',
        'ренессанс' => 'Ренессанс',
        'другой' => 'Другой'
    ];
}

if (empty($material_options)) {
    $material_options = [
        'дерево' => 'Дерево',
        'металл' => 'Металл',
        'стекло' => 'Стекло',
        'пластик' => 'Пластик',
        'ткань' => 'Ткань',
        'кожа' => 'Кожа',
        'камень' => 'Камень',
        'керамика' => 'Керамика',
        'мрамор' => 'Мрамор',
        'гранит' => 'Гранит',
        'бетон' => 'Бетон',
        'бамбук' => 'Бамбук',
        'ротанг' => 'Ротанг',
        'винил' => 'Винил',
        'другой' => 'Другой'
    ];
}

?>
<?php
// Функция для генерации опций select
function generate_select_options($options, $default_text)
{ ?>
    <option value=""><?php echo esc_html($default_text); ?></option>
    <?php foreach ($options as $value => $label): ?>
        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
    <?php endforeach ?>
<?php } ?>

<?php
// Функция для получения категорий товара по типу
function get_category_by_type($category_id, $type, $taxonomy = 'category')
{
    $category = get_term($category_id, $taxonomy);
    if (!$category || is_wp_error($category))
        return '';

    // Получаем все родительские категории
    $parent_categories = get_ancestors($category_id, $taxonomy);

    // Ищем родительскую категорию нужного типа
    foreach ($parent_categories as $parent_id) {
        $parent = get_term($parent_id, $taxonomy);
        if ($parent && !is_wp_error($parent) && $parent->slug === $type) {
            return $category->slug; // Возвращаем слаг дочерней категории
        }
    }

    return '';
}
?>