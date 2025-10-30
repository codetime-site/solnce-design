document.addEventListener("DOMContentLoaded", () => {
    adjustMainPadding();
    startSplide();
    startMaps();
    mobileMenu();
    refreshPortfolio();
    // construct();
    // startModal();
    // startCatalogFiltr();
});

function construct() {

    const canvas = new fabric.Canvas('c', { selection: false });

    // const dirliv = '<?php echo get_template_directory_uri()?>/assets/cons/living';
    // const dirkit = '<?php echo get_template_directory_uri()?>/assets/cons/kitchen';
    // const dirbed = '<?php echo get_template_directory_uri()?>/assets/cons/bdroom';
    // const direlem = '<?php echo get_template_directory_uri()?>/assets/cons/alem';
    const ROOMS = {
        living: {
            background: `${dirliv}/img_(1).webp`,
            items: [
                // потолки
                { id: 'living-ceiling1', name: 'Потолок 1', url: `${direlem}/back_1.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling2', name: 'Потолок 2', url: `${direlem}/back_3.webp`, x: 10000, y: 0, w: 500, h: 505, group: 'ceiling' },
                { id: 'living-ceiling3', name: 'Потолок 2', url: `${direlem}/back_4.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling4', name: 'Потолок 2', url: `${direlem}/back_5.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling5', name: 'Потолок 2', url: `${direlem}/back_6.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling6', name: 'Потолок 2', url: `${direlem}/back_7.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling7', name: 'Потолок 2', url: `${direlem}/back_8.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling8', name: 'Потолок 2', url: `${direlem}/back_9.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling9', name: 'Потолок 2', url: `${direlem}/back_11.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling10', name: 'Потолок 2', url: `${direlem}/back_12.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling11', name: 'Потолок 2', url: `${direlem}/back_13.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },

                // мебель
                { id: 'sofa', name: 'Диван', url: `${dirliv}/img1.webp`, x: 300, y: 350, w: 300, h: 180 },
                { id: 'shelf', name: 'Шкаф', url: `${dirliv}/img2.webp`, x: 700, y: 300, w: 150, h: 220 },
                { id: 'table', name: 'Стол', url: `${dirliv}/img3.webp`, x: 500, y: 420, w: 150, h: 100 },
                { id: 'wasa', name: 'Стasdол', url: `${dirliv}/img4.webp`, x: 500, y: 420, w: 150, h: 100 },
                { id: 'diwan', name: 'Столa', url: `${dirliv}/img5.webp`, x: 200, y: 240, w: 500, h: 600 },
                { id: 'img', name: 'Стasdол', url: `${dirliv}/img6.webp`, x: 500, y: 420, w: 150, h: 100 }
            ]
        },

        bedroom: {
            background: `${dirbed}/img_8.webp`,
            items: [
                // потолки
                { id: 'living-ceiling1', name: 'Потолок 1', url: `${direlem}/back_1.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling2', name: 'Потолок 2', url: `${direlem}/back_3.webp`, x: 10000, y: 0, w: 500, h: 505, group: 'ceiling' },
                { id: 'living-ceiling3', name: 'Потолок 2', url: `${direlem}/back_4.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling4', name: 'Потолок 2', url: `${direlem}/back_5.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling5', name: 'Потолок 2', url: `${direlem}/back_6.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling6', name: 'Потолок 2', url: `${direlem}/back_7.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling7', name: 'Потолок 2', url: `${direlem}/back_8.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling8', name: 'Потолок 2', url: `${direlem}/back_9.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling9', name: 'Потолок 2', url: `${direlem}/back_11.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling10', name: 'Потолок 2', url: `${direlem}/back_12.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling11', name: 'Потолок 2', url: `${direlem}/back_13.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },

                // мебель
                { id: 'shelf2', name: 'Шкаф', url: `${dirbed}/img2.webp`, x: 700, y: 300, w: 150, h: 220 },
                { id: 'table2', name: 'Стол', url: `${dirbed}/img3.webp`, x: 500, y: 420, w: 150, h: 100 },
                { id: 'wasa2', name: 'Стasdол', url: `${dirbed}/img4.webp`, x: 500, y: 420, w: 150, h: 100 },
                { id: 'wasa2', name: 'Стasdол', url: `${dirbed}/img6.webp`, x: 500, y: 420, w: 150, h: 100 },
                { id: 'img2', name: 'Стasdол', url: `${dirbed}/img5.webp`, x: 500, y: 420, w: 150, h: 100 }
            ]
        },

        kitchen: {
            background: `${dirkit}/img_12.webp`,
            items: [
                // потолки
                { id: 'living-ceiling1', name: 'Потолок 1', url: `${direlem}/back_1.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling2', name: 'Потолок 2', url: `${direlem}/back_3.webp`, x: 10000, y: 0, w: 500, h: 505, group: 'ceiling' },
                { id: 'living-ceiling3', name: 'Потолок 2', url: `${direlem}/back_4.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling4', name: 'Потолок 2', url: `${direlem}/back_5.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling5', name: 'Потолок 2', url: `${direlem}/back_6.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling6', name: 'Потолок 2', url: `${direlem}/back_7.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling7', name: 'Потолок 2', url: `${direlem}/back_8.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling8', name: 'Потолок 2', url: `${direlem}/back_9.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling9', name: 'Потолок 2', url: `${direlem}/back_11.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling10', name: 'Потолок 2', url: `${direlem}/back_12.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },
                { id: 'living-ceiling11', name: 'Потолок 2', url: `${direlem}/back_13.webp`, x: 0, y: 0, w: 1000, h: 505, group: 'ceiling' },

                // мебель
                { id: 'sofa1', name: 'Диван', url: `${dirkit}/img1.webp`, x: 300, y: 350, w: 300, h: 180 },
                { id: 'sofa1', name: 'Диван', url: `${dirkit}/img2.webp`, x: 300, y: 350, w: 300, h: 180 },
                { id: 'shelf1', name: 'Шкаф', url: `${dirkit}/img3.webp`, x: 700, y: 300, w: 150, h: 220 }
            ]
        }
    };

    // var ter = ROOMS.living.items;
    // console.log(ter);


    let currentRoom = 'living';
    let objects = {};

    const buttonsDiv = document.getElementById('buttons');
    const elementsDiv = document.getElementById('elements');

    function createRoomButtons() {
        buttonsDiv.innerHTML = '';
        ['living', 'bedroom', 'kitchen'].forEach(room => {
            const btn = document.createElement('button');
            btn.textContent = room === 'living' ? 'Гостиная' : room === 'bedroom' ? 'Спальня' : 'Кухня';
            btn.onclick = () => loadRoom(room);
            buttonsDiv.appendChild(btn);
        });

        const saveBtn = document.createElement('button');
        saveBtn.textContent = 'Сохранить изображение';
        saveBtn.className = 'save';
        saveBtn.onclick = saveImage;
        buttonsDiv.appendChild(saveBtn);

        const resetBtn = document.createElement('button');
        resetBtn.textContent = 'Сброс';
        resetBtn.className = 'reset';
        resetBtn.onclick = resetRoom;
        buttonsDiv.appendChild(resetBtn);
    }


    function toggleItem(id, btn) {
        const obj = objects[id];
        if (!obj) return;
        obj.visible = !obj.visible;
        btn.classList.toggle('active', obj.visible);
        canvas.requestRenderAll();
    }

    function resetRoom() {
        Object.values(objects).forEach(o => o.visible = false);
        document.querySelectorAll('#elements button').forEach(b => b.classList.remove('active'));
        canvas.requestRenderAll();
    }

    function saveImage() {
        const data = canvas.toDataURL('image/png');
        const a = document.createElement('a');
        a.href = data;
        a.download = `room-${currentRoom}.png`;
        a.click();
    }


    createRoomButtons();
    loadRoom('bedroom');

    function setBackgroundImage(url) {
        fabric.Image.fromURL(url, img => {
            const scaleX = canvas.width / img.width;
            const scaleY = canvas.height / img.height;
            const scale = Math.min(scaleX, scaleY); // ← раньше было Math.maxF
            img.scale(scale);
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        }, { crossOrigin: 'anonymous' });
    }
    function loadRoom(room) {
        currentRoom = room;

        // очистим канвас и внутренние структуры
        canvas.clear();
        objects = {};

        // Очистим UI-контейнеры — Это главное, чтобы кнопки не дублировались
        elementsDiv.innerHTML = '';
        const ceilingsDiv = document.getElementById('ceilings');
        if (ceilingsDiv) ceilingsDiv.innerHTML = '';

        const data = ROOMS[room];

        // Установим фон (если есть)
        if (data.background) {
            setBackgroundImage(data.background);
        } else {
            canvas.setBackgroundImage(null, canvas.renderAll.bind(canvas));
        }

        // Сначала создаём объекты (но скрываем их), чтобы они были в objects[]
        data.items.forEach(item => {
            // По умолчанию скрываем элементы — потом кнопки управляют видимостью
            fabric.Image.fromURL(item.url, img => {
                let isMovable = ['sofa', 'sofa', 'sofa1', 'sofa2', 'shelf', 'shelf1', 'shelf2', 'table', 'table1', 'table2', 'wasa', 'wasa1', 'wasa2', 'diwan', 'diwan1', 'diwan2', 'img', 'img2', 'img1'].includes(item.id); // только диван и стол

                img.set({
                    left: item.x,
                    top: item.y,
                    selectable: isMovable,     // разрешаем выделять только диван и стол
                    evented: isMovable,
                    hasControls: isMovable,    // показываем контроллы масштабирования/вращения
                    lockRotation: !isMovable,  // блокируем вращение для остальных
                    lockScalingFlip: true,     // чтобы не переворачивались
                    visible: !!item.defaultVisible
                });
                const scaleX = item.w / img.width;
                const scaleY = item.h / img.height;
                const scale = Math.min(scaleX, scaleY);
                img.scale(scale);
                // Если потолок должен быть "на верхнем слое", добавляем позже; для простоты добавляем все
                canvas.add(img);
                objects[item.id] = img;
                canvas.requestRenderAll();
            }, { crossOrigin: 'anonymous' });
        });

        // Теперь создаём кнопки — потолки в отдельный контейнер, остальные в elementsDiv
        data.items.forEach(item => {
            const btn = document.createElement('button');
            // делаем миниатюру фоном кнопки (если в CSS уже прописано)
            //    btn.style.backgroundImage = `url(${item.url.replace('/bdroom/', '/bdroom/thumbs/').replace('/kitchen/', '/kitchen/thumbs/')})`;
            // btn.style.backgroundImage = `url(${item.url.startsWith('assets/cons/living')
            //     ? item.url
            //     : 'https://via.placeholder.com/80x50?text=Preview'})`;


            btn.style.backgroundImage = `url(${item.url})`;
            btn.title = item.name;
            btn.textContent = ''; // текст не нужен, миниатюра
            btn.dataset.itemId = item.id;

            if (item.group === 'ceiling') {
                // потолки — в верхний контейнер
                if (ceilingsDiv) ceilingsDiv.appendChild(btn);
                // логика: при клике включаем только этот потолок и выключаем все остальные потолки
                btn.addEventListener('click', () => {
                    // выключаем все потолки для текущей комнаты
                    data.items.forEach(i => {
                        if (i.group === 'ceiling' && objects[i.id]) {
                            objects[i.id].visible = false;
                        }
                    });
                    // включаем выбранный (если готов)
                    if (objects[item.id]) {
                        objects[item.id].visible = true;
                    }
                    // обновим UI: пометим активную кнопку
                    document.querySelectorAll('#ceilings button').forEach(b => b.classList.remove('btn-active'));
                    btn.classList.add('btn-active');
                    canvas.requestRenderAll();
                });
            } else {
                // обычные предметы — в нижний контейнер, переключаются независимо
                elementsDiv.appendChild(btn);
                btn.addEventListener('click', () => {
                    const obj = objects[item.id];
                    if (!obj) return;

                    obj.visible = !obj.visible;
                    btn.classList.toggle('btn-active', obj.visible);

                    if (obj.visible) {
                        // Переносим только что включённый объект наверх
                        canvas.bringToFront(obj);
                    }

                    canvas.requestRenderAll();
                });

            }
        });
    }

    canvas.on('object:modified', e => {
        const obj = e.target;
        console.log(`Изменено: ${obj.type}`);
        console.log('Координаты:', obj.left, obj.top);
        console.log('Размер (px):', obj.width * obj.scaleX, obj.height * obj.scaleY);
    });
    function logAllObjects() {
        canvas.getObjects().forEach(o => {
            console.log(`${o.id || 'Без ID'} → x:${o.left}, y:${o.top}, w:${o.width * o.scaleX}, h:${o.height * o.scaleY}`);
        });
    }

    canvas.preserveObjectStacking = true;
    canvas.selection = false;
    canvas.renderOnAddRemove = true;
}

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