<?php
/*
Template Name: Category Hierarchy Page
Template Post Type: page
*/
get_header();
?>

<main id="main">
    <div class="container">
        <div class="header_block">
            <h2 class="title">Иерархия категорий</h2>
            <hr class="title__under">
        </div>

        <div class="block_padding_60"></div>

        <!-- Навигация по уровням -->
        <div class="hierarchy-nav">
            <div class="nav-breadcrumbs">
                <button class="nav-level-btn active" data-level="all">Все категории</button>
                <span class="nav-separator">→</span>
                <span class="nav-current-level">Выберите категорию</span>
            </div>
        </div>

        <!-- Контейнер для категорий -->
        <div class="hierarchy-container">
            <div id="categories-hierarchy" class="categories-hierarchy">
                <?php
                // Получаем все родительские категории
                $parent_categories = get_categories(array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => false,
                    'parent' => 0
                ));
                
                if (!empty($parent_categories)): ?>
                    <div class="hierarchy-level" data-level="0">
                        <div class="level-title">
                            <h3>Родительские категории</h3>
                        </div>
                        <div class="categories-grid">
                            <?php foreach ($parent_categories as $parent_cat): 
                                if ($parent_cat->slug !== 'templates'):
                                    $cat_link = esc_url(get_category_link($parent_cat->term_id));
                                    $cat_name = esc_html($parent_cat->name);
                                    $cat_count = $parent_cat->count;
                                    
                                    // Получаем изображение категории
                                    $category_image = get_field('img', 'category_' . $parent_cat->term_id);
                                    
                                    // Проверяем наличие дочерних категорий
                                    $child_categories = get_categories(array(
                                        'parent' => $parent_cat->term_id,
                                        'hide_empty' => false
                                    ));
                                    $has_children = !empty($child_categories);
                                    ?>
                                    <div class="hierarchy-category-item" 
                                         data-category-id="<?php echo $parent_cat->term_id; ?>"
                                         data-has-children="<?php echo $has_children ? 'true' : 'false'; ?>"
                                         data-level="0">
                                        
                                        <?php if ($category_image): ?>
                                            <div class="category-image">
                                                <?php if (is_array($category_image)): ?>
                                                    <img src="<?php echo esc_url($category_image['url']); ?>" alt="<?php echo esc_attr($cat_name); ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo esc_url($category_image); ?>" alt="<?php echo esc_attr($cat_name); ?>">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="category-content">
                                            <h4 class="category-name">
                                                <a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a>
                                                <?php if ($has_children): ?>
                                                    <span class="has-children-indicator">📁</span>
                                                <?php endif; ?>
                                            </h4>
                                            
                                            <?php if ($cat_count > 0): ?>
                                                <div class="category-count"><?php echo $cat_count; ?> постов</div>
                                            <?php endif; ?>
                                            
                                            <div class="category-actions">
                                                <a href="<?php echo $cat_link; ?>" class="btn btn-primary">Перейти</a>
                                                <?php if ($has_children): ?>
                                                    <button class="btn btn-secondary show-children" data-parent-id="<?php echo $parent_cat->term_id; ?>">
                                                        Подкатегории
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; 
                            endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Модальное окно для подкатегорий -->
        <div id="subcategories-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modal-title">Подкатегории</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="subcategories-list"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>

<style>
    .hierarchy-nav {
        margin-bottom: 30px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .nav-breadcrumbs {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .nav-level-btn {
        padding: 8px 16px;
        background: #c77022;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }

    .nav-level-btn:hover {
        background: #b8651f;
    }

    .nav-level-btn.active {
        background: #28a745;
    }

    .nav-separator {
        color: #666;
        font-weight: bold;
    }

    .nav-current-level {
        color: #666;
        font-style: italic;
    }

    .hierarchy-container {
        margin-top: 20px;
    }

    .hierarchy-level {
        display: block;
    }

    .hierarchy-level.hidden {
        display: none;
    }

    .level-title {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #c77022;
    }

    .level-title h3 {
        margin: 0;
        color: #333;
        font-size: 1.5rem;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .hierarchy-category-item {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
    }

    .hierarchy-category-item:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        transform: translateY(-2px);
        border-color: #c77022;
    }

    .category-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 15px auto;
        border: 3px solid #c77022;
    }

    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-content {
        text-align: center;
    }

    .category-name {
        margin: 0 0 10px 0;
        font-size: 1.3rem;
        font-weight: 600;
    }

    .category-name a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }

    .category-name a:hover {
        color: #c77022;
    }

    .has-children-indicator {
        margin-left: 8px;
        font-size: 1rem;
    }

    .category-count {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .category-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
        text-align: center;
    }

    .btn-primary {
        background: #c77022;
        color: white;
    }

    .btn-primary:hover {
        background: #b8651f;
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        color: white;
    }

    /* Модальное окно */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 0;
        border-radius: 10px;
        width: 90%;
        max-width: 800px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
        background: #f8f9fa;
        border-radius: 10px 10px 0 0;
    }

    .modal-header h3 {
        margin: 0;
        color: #333;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .modal-close:hover {
        background: #e9ecef;
        color: #333;
    }

    .modal-body {
        padding: 20px;
    }

    .subcategory-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: all 0.3s;
    }

    .subcategory-item:hover {
        background: #f8f9fa;
        border-color: #c77022;
    }

    .subcategory-info {
        flex-grow: 1;
    }

    .subcategory-name {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .subcategory-name a {
        color: #333;
        text-decoration: none;
    }

    .subcategory-name a:hover {
        color: #c77022;
    }

    .subcategory-count {
        color: #666;
        font-size: 0.9rem;
    }

    .subcategory-actions {
        margin-left: 15px;
    }

    @media (max-width: 768px) {
        .categories-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .nav-breadcrumbs {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .category-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
        
        .modal-content {
            width: 95%;
            margin: 10% auto;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showChildrenButtons = document.querySelectorAll('.show-children');
    const modal = document.getElementById('subcategories-modal');
    const modalTitle = document.getElementById('modal-title');
    const subcategoriesList = document.getElementById('subcategories-list');
    const modalClose = document.querySelector('.modal-close');
    const navLevelBtn = document.querySelector('.nav-level-btn');
    const navCurrentLevel = document.querySelector('.nav-current-level');

    // Показать подкатегории
    showChildrenButtons.forEach(button => {
        button.addEventListener('click', function() {
            const parentId = this.dataset.parentId;
            const parentName = this.closest('.hierarchy-category-item').querySelector('.category-name a').textContent;
            
            // Загружаем подкатегории через AJAX
            loadSubcategories(parentId, parentName);
        });
    });

    // Закрыть модальное окно
    modalClose.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Закрыть модальное окно при клике вне его
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Функция загрузки подкатегорий
    function loadSubcategories(parentId, parentName) {
        // Показываем заголовок
        modalTitle.textContent = `Подкатегории: ${parentName}`;
        
        // Показываем загрузку
        subcategoriesList.innerHTML = '<div style="text-align: center; padding: 20px;">Загрузка...</div>';
        modal.style.display = 'block';

        // Отправляем AJAX запрос
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=get_subcategories&parent_id=' + parentId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                displaySubcategories(data.data);
            } else {
                subcategoriesList.innerHTML = '<div style="text-align: center; padding: 20px; color: #666;">Подкатегории не найдены</div>';
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            subcategoriesList.innerHTML = '<div style="text-align: center; padding: 20px; color: #dc3545;">Ошибка загрузки подкатегорий</div>';
        });
    }

    // Функция отображения подкатегорий
    function displaySubcategories(subcategories) {
        let html = '';
        
        subcategories.forEach(category => {
            html += `
                <div class="subcategory-item">
                    <div class="subcategory-info">
                        <div class="subcategory-name">
                            <a href="${category.link}">${category.name}</a>
                        </div>
                        ${category.count > 0 ? `<div class="subcategory-count">${category.count} постов</div>` : ''}
                    </div>
                    <div class="subcategory-actions">
                        <a href="${category.link}" class="btn btn-primary">Перейти</a>
                    </div>
                </div>
            `;
        });
        
        subcategoriesList.innerHTML = html;
    }

    // Обновление навигации
    navLevelBtn.addEventListener('click', function() {
        const allLevels = document.querySelectorAll('.hierarchy-level');
        allLevels.forEach(level => {
            level.classList.remove('hidden');
        });
        navCurrentLevel.textContent = 'Все категории';
    });
});
</script>

<?php
// AJAX обработчик для получения подкатегорий
add_action('wp_ajax_get_subcategories', 'get_subcategories_handler');
add_action('wp_ajax_nopriv_get_subcategories', 'get_subcategories_handler');

function get_subcategories_handler() {
    $parent_id = intval($_POST['parent_id']);
    
    if (!$parent_id) {
        wp_send_json_error('Неверный ID родительской категории');
        return;
    }
    
    $subcategories = get_categories(array(
        'parent' => $parent_id,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC'
    ));
    
    $result = array();
    
    foreach ($subcategories as $category) {
        if ($category->slug !== 'templates') {
            $result[] = array(
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'count' => $category->count,
                'link' => get_category_link($category->term_id)
            );
        }
    }
    
    wp_send_json_success($result);
}
?>
