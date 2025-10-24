document.addEventListener("DOMContentLoaded", () => {
    adjustMainPadding();
    startSplide();
    startMaps();
    mobileMenu();
    refreshPortfolio();
    startModal();
    // startCatalogFiltr();
});

// function startCatalogFiltr(){
//     const parentFilter = document.getElementById('parent-category-filter');
//     const subcategoryFilter = document.getElementById('subcategory-filter');
//     const colorFilter = document.getElementById('color-filter');
//     const styleFilter = document.getElementById('style-filter');
//     const materialFilter = document.getElementById('material-filter');
//     const clearFiltersBtn = document.getElementById('clear-filters');
//     const productItems = document.querySelectorAll('.product-item');


//     // Массив всех фильтров для удобства
//     const filters = [parentFilter, subcategoryFilter, colorFilter, styleFilter, materialFilter];

//     // Добавляем обработчики событий для всех фильтров
//     filters.forEach(filter => {
//         filter.addEventListener('change', function () {
//             if (this === parentFilter) {
//                 updateSubcategories();
//             }
//             filterProducts();
//         });
//     });

//     // Функция обновления подкатегорий
//     function updateSubcategories() {
//         const parentId = parentFilter.value;
//         subcategoryFilter.innerHTML = '<option value="">Выберите подкатегорию</option>';

//         if (parentId) {
//             subcategoryFilter.disabled = false;
//             const subcategories = categoriesData.filter(cat => cat.parent == parentId);
//             subcategories.forEach(cat => {
//                 const option = document.createElement('option');
//                 option.value = cat.id;
//                 option.textContent = cat.name;
//                 subcategoryFilter.appendChild(option);
//             });
//         } else {
//             subcategoryFilter.disabled = true;
//         }
//     }

//     // Функция фильтрации товаров
//     function filterProducts() {
//         const filterValues = {
//             parent: parentFilter.value,
//             subcategory: subcategoryFilter.value,
//             color: colorFilter.value.toLowerCase(),
//             style: styleFilter.value.toLowerCase(),
//             material: materialFilter.value.toLowerCase()
//         };

//         let visibleCount = 0;

//         productItems.forEach(item => {
//             const itemData = {
//                 postId: item.dataset.postId,
//                 color: item.dataset.color.toLowerCase(),
//                 style: item.dataset.style.toLowerCase(),
//                 material: item.dataset.material.toLowerCase()
//             };

//             let show = true;

//             // Фильтры по атрибутам (цвет, стиль, материал) - обязательные совпадения
//             const attributeFilters = ['color', 'style', 'material'];
//             for (const attr of attributeFilters) {
//                 if (filterValues[attr] && itemData[attr] && itemData[attr] !== '') {
//                     // Точное совпадение для атрибутов
//                     show = itemData[attr] === filterValues[attr];
//                     if (!show) break;
//                 }
//             }

//             // Фильтр по категориям
//             if (show && (filterValues.parent || filterValues.subcategory)) {
//                 const itemCategoryIds = item.dataset.categoryIds ? item.dataset.categoryIds.split(',') : [];
//                 let categoryMatch = false;

//                 if (filterValues.subcategory) {
//                     // Если выбрана подкатегория, проверяем точное совпадение
//                     categoryMatch = itemCategoryIds.includes(filterValues.subcategory);
//                 } else if (filterValues.parent) {
//                     // Если выбрана родительская категория, проверяем, есть ли она или ее потомки
//                     categoryMatch = itemCategoryIds.some(id => {
//                         const catId = parseInt(id);
//                         // Проверяем, является ли категория потомком выбранной родительской
//                         return categoriesData.some(cat => cat.id == catId && (cat.id == filterValues.parent || cat.parent == filterValues.parent));
//                     });
//                 }

//                 if (!categoryMatch) {
//                     show = false;
//                 }
//             }

//             if (show) {
//                 item.classList.remove('hidden');
//                 visibleCount++;
//             } else {
//                 item.classList.add('hidden');
//             }
//         });

//         // Показываем/скрываем сообщение "не найдено"
//         let noResultsMsg = document.querySelector('.no-results');

//         if (visibleCount === 0) {
//             if (!noResultsMsg) {
//                 noResultsMsg = document.createElement('div');
//                 noResultsMsg.className = 'no-results';
//                 noResultsMsg.textContent = 'Товары не найдены по заданным критериям';
//                 document.getElementById('products-list').appendChild(noResultsMsg);
//             }
//         } else if (noResultsMsg) {
//             noResultsMsg.remove();
//         }
//     }

//     // Сброс фильтров
//     clearFiltersBtn.addEventListener('click', function () {
//         // Сбрасываем все фильтры
//         filters.forEach(filter => {
//             filter.value = '';
//         });

//         // Сбрасываем подкатегории
//         subcategoryFilter.disabled = true;
//         subcategoryFilter.innerHTML = '<option value="">Выберите подкатегорию</option>';

//         // Показываем все товары
//         productItems.forEach(item => {
//             item.classList.remove('hidden');
//         });

//         // Удаляем сообщение "не найдено"
//         const noResultsMsg = document.querySelector('.no-results');
//         if (noResultsMsg) {
//             noResultsMsg.remove();
//         }
//     });
// };


function startModal() {
    const modal = document.getElementById('myModal');
    const btns = document.querySelectorAll('.openModalBtn');
    const closeBtn = document.querySelector('#myModal .close-btn');

    if (!btns.length || !modal) return;

    btns.forEach(item => {
        item.onclick = function () {
            const form = document.querySelector('.wpcf7 form');
            if (form) {
                form.querySelector('[name="acf_title"]').value = item.dataset.title || '';
                form.querySelector('[name="acf_image"]').value = item.dataset.img || '';
                form.querySelector('[name="acf_link"]').value = item.dataset.link || '';
            }

            modal.style.display = "flex";
            setTimeout(() => {
                modal.classList.add('modal-show');
            }, 50);
        };
    });

    function closeModal() {
        modal.classList.remove('modal-show');
        setTimeout(() => {
            modal.style.display = "none";
        }, 300);
    }

    if (closeBtn) closeBtn.onclick = closeModal;

    window.onclick = function (event) {
        if (event.target === modal) closeModal();
    };

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('modal-show')) {
            closeModal();
        }
    });
}

function refreshPortfolio() {
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
};

function startMaps() {
    if (typeof mapUrl1 !== 'undefined' && document.getElementById('map1')) {
        loadMapScript('map1', mapUrl1);
    }
    if (typeof mapUrl2 !== 'undefined' && document.getElementById('map2')) {
        loadMapScript('map2', mapUrl2);
    }
}

function loadMapScript(containerId, mapUrl) {
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.charset = 'utf-8';
    script.async = true;
    script.src = mapUrl;
    document.getElementById(containerId).appendChild(script);
}


function adjustMainPadding() {
    const header = document.querySelector('.header__content');
    const main = document.querySelector('#main');
    if (header && main) {
        // console.log(header.clientHeight);
        console.log(header.clientHeight);
        console.log(header.offsetHeight);
        main.style.paddingTop = header.offsetHeight + "px";
        // main.style.paddingTop = header.offsetHeight + "px";


    }
}



function startSplide() {
    const options = {
        rewind: true,
        rewindByDrag: true,
        arrows: false,
    };
    document.querySelectorAll('.splide').forEach(el => {
        new Splide(el, options).mount();
    });

    // для поекта 
    var wins = document.querySelectorAll('.windows__project');

    wins.forEach(function (win, index) {
        var mainSlider = new Splide(`#main-slider-${index + 1}`, {
            type: 'fade',
            // heightRatio: .5,
            pagination: false, // Отключаем пагинацию для основного слайдера
            arrows: false,
            cover: true,
        });

        var thumbnailSlider = new Splide(`#thumbnail-slider-${index + 1}`, {
            rewind: true,
            fixedWidth: 124,
            fixedHeight: 78,
            isNavigation: true, // Включаем навигацию для миниатюр
            autoplay: true, // Включаем автопрокрутку
            interval: 3000, // Интервал автопрокрутки в миллисекундах (3 секунды)
            gap: 3,
            focus: 'center',
            pagination: false, // Отключаем пагинацию для миниатюр
            cover: true,
            // perPage:3,
            dragMinThreshold: {
                mouse: 3,
                touch: 10,
            },
            breakpoints: {
                564: {
                    fixedWidth: 126,
                    fixedHeight: 60,
                },
            },
        });

        mainSlider.sync(thumbnailSlider);
        mainSlider.mount();
        thumbnailSlider.mount();

    });

    const spLide = new Splide('.parent_cat__contant', {
        autoplay: true,
        interval: 1000,
        perPage: 3,
        focus: 'center',
        perMove: 2,
        arrows: false,
        pagination: false,
        resetProgress: true,
        rewind: true,
        rewindSpeed: 1000,

    });
    spLide.mount();


}

function mobileMenu() {
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu-header');

    hamburger.addEventListener('click', function () {
        hamburger.classList.toggle('active');
        menu.classList.toggle('active');
    });

    // Закрытие меню при клике на ссылку
    const menuLinks = menu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            hamburger.classList.remove('active');
            menu.classList.remove('active');
        });
    });

    // Закрытие меню при клике вне его
    document.addEventListener('click', function (event) {
        if (!hamburger.contains(event.target) && !menu.contains(event.target)) {
            hamburger.classList.remove('active');
            menu.classList.remove('active');
        }
    });
}