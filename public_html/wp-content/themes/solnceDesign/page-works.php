<main id="main">
    <div class="container">
        <div class="works-header">
            <h1 class="works-title"><?php the_title(); ?></h1>
        </div>

        <div class="block_padding_60"></div>

        <!-- Фильтр кнопки -->
        <div class="works-filter">
            <button class="filter-btn active" data-filter="all">Все работы</button>
            <button class="filter-btn" data-filter="windows">Пластиковые окна</button>
            <button class="filter-btn" data-filter="balcony">Балкон</button>
            <button class="filter-btn" data-filter="doors">Двери</button>
            <button class="filter-btn" data-filter="ceilings">Потолки</button>
        </div>

        <div class="block_padding_40"></div>

        <!-- Галерея работ -->
        <div class="works-gallery">
            <?php
            // Примерные работы с фотографиями из интернета для демонстрации
            $works = [
                [
                    'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop',
                    'category' => 'windows',
                    'title' => 'Пластиковые окна в гостиной',
                    'description' => 'Современные окна с энергосберегающим стеклом'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop',
                    'category' => 'windows',
                    'title' => 'Окна в спальне',
                    'description' => 'Шумоизоляционные окна для комфортного сна'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400&h=300&fit=crop',
                    'category' => 'balcony',
                    'title' => 'Остекление балкона',
                    'description' => 'Полное остекление с выносом'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=400&h=300&fit=crop',
                    'category' => 'balcony',
                    'title' => 'Балкон с видом',
                    'description' => 'Остекление с панорамными окнами'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop',
                    'category' => 'doors',
                    'title' => 'Входная дверь',
                    'description' => 'Металлическая дверь с декоративными элементами'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop',
                    'category' => 'doors',
                    'title' => 'Межкомнатные двери',
                    'description' => 'Двери из натурального дерева'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400&h=300&fit=crop',
                    'category' => 'ceilings',
                    'title' => 'Натяжной потолок',
                    'description' => 'Матовая поверхность в гостиной'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=400&h=300&fit=crop',
                    'category' => 'ceilings',
                    'title' => 'Многоуровневый потолок',
                    'description' => 'Потолок с LED подсветкой'
                ]
            ];

            foreach ($works as $work): ?>
                <div class="work-item" data-category="<?php echo esc_attr($work['category']); ?>">
                    <div class="work-image">
                        <img src="<?php echo esc_url($work['image']); ?>" alt="<?php echo esc_attr($work['title']); ?>">
                    </div>
                    <div class="work-content">
                        <h3 class="work-title"><?php echo esc_html($work['title']); ?></h3>
                        <p class="work-description"><?php echo esc_html($work['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php // include(get_template_directory() . '/constructor.php'); ?>
    </div>
</main>


