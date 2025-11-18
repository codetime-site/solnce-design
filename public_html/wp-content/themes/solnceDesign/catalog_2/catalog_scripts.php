<script>
    // catalog_script.php

    document.addEventListener("DOMContentLoaded", startCatalogFiltr);

    function startCatalogFiltr() {
        const parentFilter = document.getElementById('parent-category-filter');
        const subcategoryFilter = document.getElementById('subcategory-filter');
        const colorFilter = document.getElementById('color-filter');
        const styleFilter = document.getElementById('style-filter');
        const materialFilter = document.getElementById('material-filter');
        const clearFiltersBtn = document.getElementById('clear-filters');
        const productsList = document.getElementById('products-list');
        const paginationContainer = document.getElementById('pagination-container');

        // Текущая страница
        let currentPage = 1;
        let currentFilters = {
            category: '',
            subcategory: '',
            color: '',
            style: '',
            material: ''
        };

        // Массив всех фильтров для удобства
        const filters = [parentFilter, subcategoryFilter, colorFilter, styleFilter, materialFilter];

        // Инициализация: загружаем первую страницу
        loadProducts(currentPage, currentFilters);

        // Обработчики для фильтров
        filters.forEach(filter => {
            filter.addEventListener('change', function () {
                if (this === parentFilter) {
                    updateSubcategories();
                }
                // Сбрасываем на первую страницу при изменении фильтра
                currentPage = 1;
                updateCurrentFilters();
                loadProducts(currentPage, currentFilters);
            });
        });

        // Обработчик сброса фильтров
        clearFiltersBtn.addEventListener('click', function () {
            filters.forEach(filter => {
                filter.value = '';
            });
            subcategoryFilter.disabled = true;
            subcategoryFilter.innerHTML = '<option value="">Выберите подкатегорию</option>';
            currentPage = 1;
            updateCurrentFilters();
            loadProducts(currentPage, currentFilters);
        });

        // Функция обновления подкатегорий
        function updateSubcategories() {
            const parentId = parentFilter.value;
            subcategoryFilter.innerHTML = '<option value="">Выберите подкатегорию</option>';
            if (parentId) {
                subcategoryFilter.disabled = false;
                const subcategories = categoriesData.filter(cat => cat.parent == parentId);
                subcategories.forEach(cat => {
                    const option = document.createElement('option');
                    option.value = cat.id;
                    option.textContent = cat.name;
                    subcategoryFilter.appendChild(option);
                });
            } else {
                subcategoryFilter.disabled = true;
            }
        }

        // Функция обновления текущих фильтров
        function updateCurrentFilters() {
            currentFilters = {
                category: parentFilter.value,
                subcategory: subcategoryFilter.value,
                color: colorFilter.value,
                style: styleFilter.value,
                material: materialFilter.value
            };
        }

        // Функция загрузки товаров через AJAX
        function loadProducts(page, filters) {
            const data = {
                action: 'load_catalog_products',
                page: page,
                posts_per_page: postsPerPage,
                category: filters.category,
                sub_category: filters.subcategory,
                color: filters.color,
                style: filters.style,
                material: filters.material
            };

            // Показываем индикатор загрузки
            productsList.innerHTML = '<div class="loading">Загрузка...</div>';
            paginationContainer.innerHTML = '';

            fetch(ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(data)
            })
                .then(response => response.text())
                .then(responseText => {
                    // Извлекаем общее количество постов из ответа
                    const totalPostsMatch = responseText.match(/<!--TOTAL_POSTS-->(\d+)<!--\/TOTAL_POSTS-->/);
            const totalPosts = totalPostsMatch ? parseInt(totalPostsMatch[1]) : 0;

                    // Убираем метку из HTML
                    const htmlContent = responseText.replace(/<!--TOTAL_POSTS-->\d+<!--\/TOTAL_POSTS-->/g, '');

                    // Обновляем контейнер с товарами
                    productsList.innerHTML = htmlContent;

                    // Обновляем пагинацию
                    renderPagination(page, totalPosts);
                })
                .catch(error => {
                    console.error('Error loading products:', error);
                    productsList.innerHTML = '<div class="error">Ошибка загрузки товаров.</div>';
                });
        }

        // Функция генерации пагинации
        function renderPagination(currentPage, totalPosts) {
            const totalPages = Math.ceil(totalPosts / postsPerPage);
            if (totalPages <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }

            let paginationHTML = '<div class="pagination">';
            for (let i = 1; i <= totalPages; i++) {
                if (i === currentPage) {
                    paginationHTML += `<span class="page-numbers current">${i}</span>`;
                } else {
                    paginationHTML += `<a href="#" class="page-numbers" data-page="${i}">${i}</a>`;
                }
            }
            paginationHTML += '</div>';

            paginationContainer.innerHTML = paginationHTML;

            // Добавляем обработчики для кнопок пагинации
            paginationContainer.querySelectorAll('.page-numbers:not(.current)').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const page = parseInt(this.getAttribute('data-page'));
                    if (page !== currentPage) {
                        currentPage = page;
                        loadProducts(currentPage, currentFilters);
                    }
                });
            });
        }
    }
</script>