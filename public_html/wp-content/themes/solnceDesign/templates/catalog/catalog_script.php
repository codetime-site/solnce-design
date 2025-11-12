<script>
    // Данные о категориях для JavaScript
    const categoriesData = <?php
    $js_categories = array();
    foreach ($all_categories as $cat) {
        if ($cat->slug !== 'templates') {
            $js_categories[] = array(
                'id' => $cat->term_id,
                'name' => $cat->name,
                'parent' => $cat->parent
            );
        }
    }
    echo json_encode($js_categories);
    ?>;
    document.addEventListener("DOMContentLoaded", startCatalogFiltr);

    function startCatalogFiltr() {
        const parentFilter = document.getElementById('parent-category-filter');
        const subcategoryFilter = document.getElementById('subcategory-filter');
        const colorFilter = document.getElementById('color-filter');
        const styleFilter = document.getElementById('style-filter');
        const materialFilter = document.getElementById('material-filter');
        const clearFiltersBtn = document.getElementById('clear-filters');
        const productItems = document.querySelectorAll('.product-item');


        // Массив всех фильтров для удобства
        const filters = [parentFilter, subcategoryFilter, colorFilter, styleFilter, materialFilter];

        // Добавляем обработчики событий для всех фильтров
        filters.forEach(filter => {
            filter.addEventListener('change', function () {
                if (this === parentFilter) {
                    updateSubcategories();
                }
                filterProducts();
            });
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

        // Функция фильтрации товаров
        function filterProducts() {
            const filterValues = {
                parent: parentFilter.value,
                subcategory: subcategoryFilter.value,
                color: colorFilter.value.toLowerCase(),
                style: styleFilter.value.toLowerCase(),
                material: materialFilter.value.toLowerCase()
            };

            let visibleCount = 0;

            productItems.forEach(item => {
                const itemData = {
                    postId: item.dataset.postId,
                    color: item.dataset.color.toLowerCase(),
                    style: item.dataset.style.toLowerCase(),
                    material: item.dataset.material.toLowerCase()
                };

                let show = true;

                // Фильтры по атрибутам (цвет, стиль, материал) - обязательные совпадения
                const attributeFilters = ['color', 'style', 'material'];
                for (const attr of attributeFilters) {
                    if (filterValues[attr] && itemData[attr] && itemData[attr] !== '') {
                        // Точное совпадение для атрибутов
                        show = itemData[attr] === filterValues[attr];
                        if (!show) break;
                    }
                }

                // Фильтр по категориям
                if (show && (filterValues.parent || filterValues.subcategory)) {
                    const itemCategoryIds = item.dataset.categoryIds ? item.dataset.categoryIds.split(',') : [];
                    let categoryMatch = false;

                    if (filterValues.subcategory) {
                        // Если выбрана подкатегория, проверяем точное совпадение
                        categoryMatch = itemCategoryIds.includes(filterValues.subcategory);
                    } else if (filterValues.parent) {
                        // Если выбрана родительская категория, проверяем, есть ли она или ее потомки
                        categoryMatch = itemCategoryIds.some(id => {
                            const catId = parseInt(id);
                            // Проверяем, является ли категория потомком выбранной родительской
                            return categoriesData.some(cat => cat.id == catId && (cat.id == filterValues.parent || cat.parent == filterValues.parent));
                        });
                    }

                    if (!categoryMatch) {
                        show = false;
                    }
                }

                if (show) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            // Показываем/скрываем сообщение "не найдено"
            let noResultsMsg = document.querySelector('.no-results');

            if (visibleCount === 0) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('div');
                    noResultsMsg.className = 'no-results';
                    noResultsMsg.textContent = 'Товары не найдены по заданным критериям';
                    document.getElementById('products-list').appendChild(noResultsMsg);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }

        // Сброс фильтров
        clearFiltersBtn.addEventListener('click', function () {
            // Сбрасываем все фильтры
            filters.forEach(filter => {
                filter.value = '';
            });

            // Сбрасываем подкатегории
            subcategoryFilter.disabled = true;
            subcategoryFilter.innerHTML = '<option value="">Выберите подкатегорию</option>';

            // Показываем все товары
            productItems.forEach(item => {
                item.classList.remove('hidden');
            });

            // Удаляем сообщение "не найдено"
            const noResultsMsg = document.querySelector('.no-results');
            if (noResultsMsg) {
                noResultsMsg.remove();
            }
        });
    };

</script>