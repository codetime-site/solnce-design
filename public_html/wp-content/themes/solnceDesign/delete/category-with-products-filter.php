<?php
/*
Template Name: Category with Products Filter
Template Post Type: page
*/
get_header();

// Получаем текущую категорию из URL
$current_category = get_queried_object();
$category_id = $current_category ? $current_category->term_id : 0;
?>

<main id="main">
    <div class="container">
        <div class="header_block">
            <h2 class="title"><?php echo $current_category ? single_cat_title('', false) : 'Категория'; ?></h2>
            <hr class="title__under">
        </div>

        <div class="block_padding_60"></div>

        <?php if ($current_category && category_description()): ?>
            <div class="category-description">
                <?php echo category_description(); ?>
            </div>
            <div class="block_padding_30"></div>
        <?php endif; ?>

        <!-- Фильтр товаров -->
        <div class="products-filter-wrapper">
            <div class="products-filter">
                <h3>Фильтр товаров:</h3>
                <div class="filter-controls">
                    <select id="price-filter" class="filter-select">
                        <option value="">Любая цена</option>
                        <option value="0-1000">До 1000 руб.</option>
                        <option value="1000-5000">1000-5000 руб.</option>
                        <option value="5000-10000">5000-10000 руб.</option>
                        <option value="10000+">От 10000 руб.</option>
                    </select>
                    
                    <select id="sort-filter" class="filter-select">
                        <option value="date">По дате (новые)</option>
                        <option value="title">По названию (А-Я)</option>
                        <option value="title-desc">По названию (Я-А)</option>
                        <option value="price-asc">По цене (возрастание)</option>
                        <option value="price-desc">По цене (убывание)</option>
                    </select>
                    
                    <input type="text" id="search-filter" class="filter-input" placeholder="Поиск по названию...">
                    
                    <button id="clear-product-filters" class="clear-filters-btn">Сбросить</button>
                </div>
            </div>
        </div>

        <!-- Список товаров/постов -->
        <div class="products-container">
            <div id="products-list" class="products-grid">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'post_status' => 'publish'
                );

                if ($category_id) {
                    $args['cat'] = $category_id;
                }

                // Исключаем категорию "Templates"
                $templates_cat = get_term_by('slug', 'templates', 'category');
                if ($templates_cat) {
                    $args['category__not_in'] = array($templates_cat->term_id);
                }

                $products_query = new WP_Query($args);
                
                if ($products_query->have_posts()): 
                    while ($products_query->have_posts()): 
                        $products_query->the_post();
                        
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_excerpt = get_the_excerpt();
                        $post_date = get_the_date();
                        $post_link = get_permalink();
                        
                        // Получаем цену из ACF (если используется)
                        $price = get_field('price', $post_id);
                        $price_value = $price ? floatval($price) : 0;
                        
                        // Получаем изображение
                        $thumbnail = get_the_post_thumbnail_url($post_id, 'medium');
                        if (!$thumbnail) {
                            $thumbnail = get_template_directory_uri() . '/assets/img/placeholder.jpg';
                        }
                        ?>
                        <div class="product-item" 
                             data-price="<?php echo $price_value; ?>" 
                             data-title="<?php echo esc_attr(strtolower($post_title)); ?>"
                             data-date="<?php echo get_the_date('Y-m-d'); ?>">
                            
                            <div class="product-image">
                                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($post_title); ?>">
                            </div>
                            
                            <div class="product-content">
                                <h3 class="product-title">
                                    <a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a>
                                </h3>
                                
                                <?php if ($price): ?>
                                    <div class="product-price"><?php echo number_format($price_value, 0, ',', ' '); ?> руб.</div>
                                <?php endif; ?>
                                
                                <?php if ($post_excerpt): ?>
                                    <div class="product-excerpt"><?php echo wp_trim_words($post_excerpt, 20); ?></div>
                                <?php endif; ?>
                                
                                <div class="product-meta">
                                    <span class="product-date"><?php echo $post_date; ?></span>
                                </div>
                            </div>
                            
                            <div class="product-actions">
                                <a href="<?php echo $post_link; ?>" class="product-link btn">Подробнее</a>
                            </div>
                        </div>
                    <?php endwhile; 
                    wp_reset_postdata();
                else: ?>
                    <div class="no-products">
                        <p>В этой категории пока нет товаров.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Пагинация (если нужно) -->
        <?php if ($products_query->max_num_pages > 1): ?>
            <div class="pagination-wrapper">
                <?php
                echo paginate_links(array(
                    'total' => $products_query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'format' => '?paged=%#%',
                    'prev_text' => '← Предыдущая',
                    'next_text' => 'Следующая →',
                ));
                ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>

<style>
    .products-filter-wrapper {
        margin-bottom: 40px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .products-filter h3 {
        margin-bottom: 15px;
        color: #333;
        font-size: 1.2rem;
    }

    .filter-controls {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-select, .filter-input {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: white;
        font-size: 14px;
        min-width: 180px;
    }

    .filter-input {
        flex-grow: 1;
        max-width: 300px;
    }

    .clear-filters-btn {
        padding: 8px 16px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s;
    }

    .clear-filters-btn:hover {
        background: #c82333;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .product-item {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        opacity: 1;
        transform: scale(1);
    }

    .product-item.hidden {
        opacity: 0;
        transform: scale(0.9);
        pointer-events: none;
    }

    .product-item:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }

    .product-image {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: #f5f5f5;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-item:hover .product-image img {
        transform: scale(1.05);
    }

    .product-content {
        padding: 20px;
    }

    .product-title {
        margin: 0 0 10px 0;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .product-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }

    .product-title a:hover {
        color: #c77022;
    }

    .product-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #c77022;
        margin-bottom: 10px;
    }

    .product-excerpt {
        color: #666;
        line-height: 1.5;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    .product-meta {
        font-size: 0.8rem;
        color: #999;
        margin-bottom: 15px;
    }

    .product-actions {
        padding: 0 20px 20px 20px;
    }

    .product-link {
        display: inline-block;
        padding: 10px 20px;
        background: #c77022;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        transition: background 0.3s;
        text-align: center;
        width: 100%;
    }

    .product-link:hover {
        background: #b8651f;
        color: white;
    }

    .no-products {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: #666;
        font-size: 1.1rem;
    }

    .pagination-wrapper {
        margin-top: 40px;
        text-align: center;
    }

    .pagination-wrapper .page-numbers {
        display: inline-block;
        padding: 8px 12px;
        margin: 0 2px;
        background: #f8f9fa;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .pagination-wrapper .page-numbers:hover,
    .pagination-wrapper .page-numbers.current {
        background: #c77022;
        color: white;
    }

    .category-description {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #c77022;
        margin-bottom: 20px;
        font-size: 1rem;
        line-height: 1.6;
        color: #555;
    }

    @media (max-width: 768px) {
        .filter-controls {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-select, .filter-input {
            min-width: auto;
            width: 100%;
        }
        
        .products-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const priceFilter = document.getElementById('price-filter');
    const sortFilter = document.getElementById('sort-filter');
    const searchFilter = document.getElementById('search-filter');
    const clearFiltersBtn = document.getElementById('clear-product-filters');
    const productItems = document.querySelectorAll('.product-item');
    
    // Функция фильтрации товаров
    function filterProducts() {
        const selectedPrice = priceFilter.value;
        const selectedSort = sortFilter.value;
        const searchTerm = searchFilter.value.toLowerCase();
        
        let visibleProducts = [];
        
        productItems.forEach(item => {
            const price = parseFloat(item.dataset.price) || 0;
            const title = item.dataset.title;
            const date = item.dataset.date;
            
            let show = true;
            
            // Фильтр по цене
            if (selectedPrice) {
                switch (selectedPrice) {
                    case '0-1000':
                        show = show && price <= 1000;
                        break;
                    case '1000-5000':
                        show = show && price >= 1000 && price <= 5000;
                        break;
                    case '5000-10000':
                        show = show && price >= 5000 && price <= 10000;
                        break;
                    case '10000+':
                        show = show && price >= 10000;
                        break;
                }
            }
            
            // Фильтр по поиску
            if (searchTerm) {
                show = show && title.includes(searchTerm);
            }
            
            if (show) {
                item.classList.remove('hidden');
                visibleProducts.push({
                    element: item,
                    price: price,
                    title: item.querySelector('.product-title a').textContent,
                    date: date
                });
            } else {
                item.classList.add('hidden');
            }
        });
        
        // Сортировка
        if (selectedSort && visibleProducts.length > 0) {
            visibleProducts.sort((a, b) => {
                switch (selectedSort) {
                    case 'title':
                        return a.title.localeCompare(b.title);
                    case 'title-desc':
                        return b.title.localeCompare(a.title);
                    case 'price-asc':
                        return a.price - b.price;
                    case 'price-desc':
                        return b.price - a.price;
                    case 'date':
                    default:
                        return new Date(b.date) - new Date(a.date);
                }
            });
            
            // Переставляем элементы в DOM
            const productsGrid = document.getElementById('products-list');
            visibleProducts.forEach(product => {
                productsGrid.appendChild(product.element);
            });
        }
        
        // Показываем сообщение, если нет результатов
        const visibleCount = document.querySelectorAll('.product-item:not(.hidden)').length;
        let noResultsMsg = document.querySelector('.no-results-filtered');
        
        if (visibleCount === 0) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.className = 'no-products no-results-filtered';
                noResultsMsg.innerHTML = '<p>Товары не найдены по заданным критериям.</p>';
                document.getElementById('products-list').appendChild(noResultsMsg);
            }
        } else {
            if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }
    }
    
    // Обработчики событий
    priceFilter.addEventListener('change', filterProducts);
    sortFilter.addEventListener('change', filterProducts);
    searchFilter.addEventListener('input', filterProducts);
    
    clearFiltersBtn.addEventListener('click', function() {
        priceFilter.value = '';
        sortFilter.value = 'date';
        searchFilter.value = '';
        
        productItems.forEach(item => {
            item.classList.remove('hidden');
        });
        
        const noResultsMsg = document.querySelector('.no-results-filtered');
        if (noResultsMsg) {
            noResultsMsg.remove();
        }
        
        // Сбрасываем сортировку к исходному порядку
        const productsGrid = document.getElementById('products-list');
        const allProducts = Array.from(productItems);
        allProducts.sort((a, b) => {
            const aIndex = Array.from(productsGrid.children).indexOf(a);
            const bIndex = Array.from(productsGrid.children).indexOf(b);
            return aIndex - bIndex;
        });
        
        allProducts.forEach(product => {
            productsGrid.appendChild(product);
        });
    });
});
</script>
