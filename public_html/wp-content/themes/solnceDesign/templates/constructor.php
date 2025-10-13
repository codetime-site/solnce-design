
<section id="main">
    <div class="header">
        <h1>🏠 Умный конструктор интерьера</h1>
        <p>Выберите тип комнаты и создайте идеальный интерьер</p>

        <!-- Главное меню выбора комнаты -->
        <div class="room-selector">
            <button class="room-button active" data-room="livingroom">🛋️ Гостиная</button>
            <button class="room-button" data-room="kitchen">🍳 Кухня</button>
            <button class="room-button" data-room="bedroom">🛏️ Спальня</button>
        </div>

        <!-- Подменю выбора категории -->
        <div class="category-selector">
            <button class="category-button active" data-category="furniture">🪑 Мебель</button>
            <button class="category-button" data-category="decor">🖼️ Декор</button>
            <button class="category-button" data-category="chair">🪑 Кресло</button>
            <button class="category-button" data-category="ceiling">💡 Потолки</button>
        </div>
    </div>

    <div class="constructor-container">
        <div class="panel left-panel">
            <div class="elements-grid" id="elements-grid">
                <!-- Здесь будут отображаться миниатюры элементов -->
            </div>
        </div>

        <div class="panel center-panel">
            <div class="scene-container">
                <div class="loading">Загрузка...</div>
                <div class="scene-bg" id="scene-bg"></div>

                <!-- Зоны для размещения элементов -->
                <div class="zone floor-zone" id="floor-zone"></div>
                <div class="zone wall-zone" id="wall-zone"></div>
                <div class="zone ceiling-zone" id="ceiling-zone"></div>
            </div>

            <div class="controls">
                <button class="control-button" onclick="saveDesignAsPhoto()">📸 Сохранить как фото</button>
                <button class="control-button" onclick="uploadDesignPhoto()">📤 Загрузить фото</button>
                <button class="control-button" onclick="sendRequest()">📧 Отправить заявку</button>
                <button class="control-button" onclick="toggleDebugMode()">🔍 Показать зоны</button>
            </div>

            <!-- Форма для загрузки фотографий -->
            <div class="photo-upload-form" id="photo-upload-form" style="display: none;">
                <h3>Загрузить фото дизайна</h3>
                <input type="file" id="photo-input" accept="image/*" multiple>
                <button class="control-button" onclick="processUploadedPhotos()">Обработать фото</button>
                <button class="control-button" onclick="closePhotoForm()">Закрыть</button>
            </div>

            <div class="room-info">
                <h3 id="current-room-title">Гостиная</h3>
                <p id="current-category-title">Мебель</p>
            </div>
        </div>

        <div class="panel right-panel">
            <div class="element-details" id="element-details">
                <h3>Выберите элемент</h3>
                <p>Кликните на элемент слева для просмотра деталей</p>
            </div>
        </div>
    </div>

    <!-- Форма сброса внизу страницы -->
    <div class="reset-form">
        <div class="reset-container">
            <h3>Управление дизайном</h3>
            <div class="reset-buttons">
                <button class="reset-button" onclick="resetCurrentRoom()">🔄 Сбросить текущую комнату</button>
                <button class="reset-button danger" onclick="resetAllRooms()">🗑️ Сбросить все комнаты</button>
                <button class="reset-button" onclick="exportAllDesigns()">💾 Экспорт всех дизайнов</button>
            </div>
        </div>
    </div>
</section>
<script>
    // Конфигурация комнат и элементов
    var dirUri = "<?php echo get_template_directory_uri(); ?>";

    // Конфигурация комнат с фоновыми изображениями
    const roomConfig = {
        livingroom: {
            name: 'Гостиная',
            background: 'http://solnce-design.ru/wp-content/uploads/2025/10/gest.jpg',
            categories: ['furniture', 'decor', 'chair', 'ceiling'],
            zones: {
                furniture: { bottom: '50px', left: '180px', width: '200px', height: '150px' },
                decor: { top: '100px', left: '250px', width: '150px', height: '100px' },
                chair: { bottom: '40px', right: '150px', width: '120px', height: '120px' },
                ceiling: { top: '30px', left: '50%', transform: 'translateX(-50%)', width: '100px', height: '80px' }
            }
        },
        kitchen: {
            name: 'Кухня',
            background: 'http://solnce-design.ru/wp-content/uploads/2025/10/kuhnya1con.jpg',
            categories: ['furniture', 'chair', 'ceiling'], // декор скрыт
            zones: {
                furniture: { bottom: '40px', left: '200px', width: '180px', height: '140px' },
                chair: { bottom: '40px', right: '150px', width: '100px', height: '100px' },
                ceiling: { top: '30px', left: '50%', transform: 'translateX(-50%)', width: '100px', height: '80px' }
            }
        },
        bedroom: {
            name: 'Спальня',
            background: 'http://solnce-design.ru/wp-content/uploads/2025/10/bedroom.jpg',
            categories: ['furniture', 'decor', 'ceiling'],
            zones: {
                furniture: { bottom: '40px', left: '100px', width: '220px', height: '160px' },
                decor: { top: '120px', left: '150px', width: '120px', height: '80px' },
                ceiling: { top: '20px', left: '50%', transform: 'translateX(-50%)', width: '100px', height: '80px' }
            }
        }
    };

    // Конфигурация элементов по категориям
    const elementsConfig = {
        furniture: {
            sofa: {
                name: 'Диван',
                image: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=200&q=80'
            },
            table: {
                name: 'Стол',
                image: 'https://images.unsplash.com/photo-1549497538-303791108f95?auto=format&fit=crop&w=200&q=80'
            },
            bed: {
                name: 'Кровать',
                image: 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=200&q=80'
            },
            wardrobe: {
                name: 'Шкаф',
                image: `${dirUri}/images/cabinet_wardrobe.png`
            }
        },
        decor: {
            painting: {
                name: 'Картина',
                image: 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=200&q=80'
            },
            plants: {
                name: 'Растения',
                image: 'https://images.unsplash.com/photo-1493957988430-a5f2e15f39a3?auto=format&fit=crop&w=200&q=80'
            },
            mirror: {
                name: 'Зеркало',
                image: 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=200&q=80'
            }
        },
        chair: {
            armchair: {
                name: 'Кресло',
                image: 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=200&q=80'
            },
            diningchair: {
                name: 'Стул',
                image: 'https://images.unsplash.com/photo-1549497538-303791108f95?auto=format&fit=crop&w=200&q=80'
            },
            officechair: {
                name: 'Офисное кресло',
                image: 'https://images.unsplash.com/photo-1541558869434-2840d308329a?auto=format&fit=crop&w=200&q=80'
            }
        },
        ceiling: {
            chandelier: {
                name: 'Люстра',
                image: 'https://images.unsplash.com/photo-1524634126442-357e0eac3c14?auto=format&fit=crop&w=200&q=80'
            },
            spotlight: {
                name: 'Точечные светильники',
                image: `${dirUri}/images/lighting_ceiling.png`
            },
            led: {
                name: 'LED подсветка',
                image: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=200&q=80'
            }
        }
    };

    // Текущее состояние конструктора
    let currentRoom = 'livingroom';
    let currentCategory = 'furniture';
    let currentState = {
        livingroom: { furniture: null, decor: null, chair: null, ceiling: null },
        kitchen: { furniture: null, chair: null, ceiling: null },
        bedroom: { furniture: null, decor: null, ceiling: null }
    };

    // Инициализация
    document.addEventListener('DOMContentLoaded', function () {
        loadState();
        initializeRoom();
        attachEventListeners();
        hideLoading();
    });

    // Загрузка состояния из localStorage
    function loadState() {
        const savedState = localStorage.getItem('interiorDesign');
        if (savedState) {
            const data = JSON.parse(savedState);
            currentState = data.state || currentState;
            currentRoom = data.room || currentRoom;
            currentCategory = data.category || currentCategory;
        }
    }

    // Сохранение состояния в localStorage
    function saveState() {
        const data = {
            state: currentState,
            room: currentRoom,
            category: currentCategory
        };
        localStorage.setItem('interiorDesign', JSON.stringify(data));
    }

    // Инициализация комнаты
    function initializeRoom() {
        switchRoom(currentRoom);
        switchCategory(currentCategory);
    }

    // Скрытие индикатора загрузки
    function hideLoading() {
        const loading = document.querySelector('.loading');
        if (loading) {
            loading.style.display = 'none';
        }
    }

    // Привязка обработчиков событий
    function attachEventListeners() {
        // Обработчики для кнопок комнат
        const roomButtons = document.querySelectorAll('.room-button');
        roomButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const room = this.dataset.room;
                switchRoom(room);
            });
        });

        // Обработчики для кнопок категорий
        const categoryButtons = document.querySelectorAll('.category-button');
        categoryButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const category = this.dataset.category;
                switchCategory(category);
            });
        });
    }

    // Переключение комнаты
    function switchRoom(roomId) {
        currentRoom = roomId;
        const room = roomConfig[roomId];

        // Обновляем фон
        const sceneBg = document.getElementById('scene-bg');
        sceneBg.style.backgroundImage = `url('${room.background}')`;

        // Обновляем заголовок
        document.getElementById('current-room-title').textContent = room.name;

        // Обновляем активную кнопку комнаты
        document.querySelectorAll('.room-button').forEach(btn => btn.classList.remove('active'));
        document.querySelector(`[data-room="${roomId}"]`).classList.add('active');

        // Показываем/скрываем категории
        updateCategoryVisibility(room.categories);

        // Очищаем все зоны
        clearAllZones();

        // Восстанавливаем элементы для текущей комнаты
        restoreRoomElements();

        // Обновляем сетку элементов
        updateElementsGrid();

        saveState();
    }

    // Переключение категории
    function switchCategory(categoryId) {
        currentCategory = categoryId;

        // Обновляем заголовок
        const categoryNames = {
            furniture: 'Мебель',
            decor: 'Декор',
            chair: 'Кресло',
            ceiling: 'Потолки'
        };
        document.getElementById('current-category-title').textContent = categoryNames[categoryId];

        // Обновляем активную кнопку категории
        document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
        const categoryBtn = document.querySelector(`[data-category="${categoryId}"]`);
        if (categoryBtn) categoryBtn.classList.add('active');

        // Обновляем сетку элементов
        updateElementsGrid();

        saveState();
    }

    // Обновление видимости категорий
    function updateCategoryVisibility(availableCategories) {
        document.querySelectorAll('.category-button').forEach(btn => {
            const category = btn.dataset.category;
            if (availableCategories.includes(category)) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });

        // Если текущая категория скрыта, переключаемся на первую доступную
        if (!availableCategories.includes(currentCategory)) {
            switchCategory(availableCategories[0]);
        }
    }

    // Обновление сетки элементов
    function updateElementsGrid() {
        const grid = document.getElementById('elements-grid');
        grid.innerHTML = '';

        const elements = elementsConfig[currentCategory];
        if (!elements) return;

        Object.keys(elements).forEach(elementId => {
            const element = elements[elementId];
            const item = createElementItem(elementId, element);
            grid.appendChild(item);
        });
    }

    // Создание элемента в сетке
    function createElementItem(elementId, element) {
        const item = document.createElement('div');
        item.className = 'element-item';
        item.dataset.elementId = elementId;
        item.dataset.category = currentCategory;

        // Проверяем, выбран ли этот элемент
        if (currentState[currentRoom][currentCategory] === elementId) {
            item.classList.add('selected');
        }

        item.innerHTML = `
                <div class="element-thumbnail" style="background-image: url('${element.image}')"></div>
                <div class="element-name">${element.name}</div>
            `;

        item.addEventListener('click', function () {
            selectElement(elementId, currentCategory);
        });

        return item;
    }

    // Выбор элемента
    function selectElement(elementId, category) {
        // Обновляем состояние
        currentState[currentRoom][category] = elementId;

        // Размещаем элемент в зоне
        placeElementInZone(elementId, category);

        // Обновляем выделение в сетке
        document.querySelectorAll('.element-item').forEach(item => item.classList.remove('selected'));
        document.querySelector(`[data-element-id="${elementId}"]`).classList.add('selected');

        // Обновляем детали элемента
        updateElementDetails(elementId, category);

        saveState();
    }

    // Размещение элемента в зоне
    function placeElementInZone(elementId, category) {
        const room = roomConfig[currentRoom];
        const element = elementsConfig[category][elementId];
        const zoneConfig = room.zones[category];

        if (!zoneConfig || !element) return;

        // Очищаем предыдущий элемент этой категории
        const existingElement = document.querySelector(`[data-category="${category}"][data-room="${currentRoom}"]`);
        if (existingElement) {
            existingElement.remove();
        }

        // Создаем новый элемент
        const img = document.createElement('img');
        img.src = element.image;
        img.className = 'zone-element fade-in';
        img.dataset.category = category;
        img.dataset.room = currentRoom;
        img.dataset.elementId = elementId;

        // Применяем позиционирование из конфигурации комнаты
        Object.keys(zoneConfig).forEach(prop => {
            img.style[prop] = zoneConfig[prop];
        });

        // Добавляем в соответствующую зону
        const zone = document.querySelector('.scene-container');
        zone.appendChild(img);

        // Обработка ошибок загрузки
        img.onerror = function () {
            console.warn(`Не удалось загрузить изображение: ${element.image}`);
            this.style.background = 'rgba(200, 200, 200, 0.5)';
            this.style.border = '2px dashed #ccc';
        };
    }

    // Обновление деталей элемента
    function updateElementDetails(elementId, category) {
        const element = elementsConfig[category][elementId];
        const details = document.getElementById('element-details');

        details.innerHTML = `
                <h3>${element.name}</h3>
                <div class="element-thumbnail" style="background-image: url('${element.image}'); width: 100px; height: 80px; margin: 10px 0;"></div>
                <p><strong>Категория:</strong> ${getCategoryName(category)}</p>
                <p><strong>Комната:</strong> ${roomConfig[currentRoom].name}</p>
                <button class="control-button" onclick="removeElement('${category}')" style="margin-top: 10px;">Убрать элемент</button>
            `;
    }

    // Получение названия категории
    function getCategoryName(category) {
        const names = {
            furniture: 'Мебель',
            decor: 'Декор',
            chair: 'Кресло',
            ceiling: 'Потолки'
        };
        return names[category] || category;
    }

    // Удаление элемента
    function removeElement(category) {
        currentState[currentRoom][category] = null;

        // Удаляем элемент из зоны
        const element = document.querySelector(`[data-category="${category}"][data-room="${currentRoom}"]`);
        if (element) {
            element.classList.add('fade-out');
            setTimeout(() => element.remove(), 300);
        }

        // Обновляем сетку и детали
        updateElementsGrid();
        document.getElementById('element-details').innerHTML = `
                <h3>Выберите элемент</h3>
                <p>Кликните на элемент слева для просмотра деталей</p>
            `;

        saveState();
    }

    // Очистка всех зон
    function clearAllZones() {
        const elements = document.querySelectorAll('.zone-element');
        elements.forEach(element => element.remove());
    }

    // Восстановление элементов комнаты
    function restoreRoomElements() {
        const roomState = currentState[currentRoom];
        Object.keys(roomState).forEach(category => {
            const elementId = roomState[category];
            if (elementId) {
                placeElementInZone(elementId, category);
            }
        });
    }


    // Сохранение дизайна
    function saveDesign() {
        const designData = {
            timestamp: new Date().toISOString(),
            room: currentRoom,
            category: currentCategory,
            state: currentState,
            totalPrice: calculateTotalPrice()
        };

        const blob = new Blob([JSON.stringify(designData, null, 2)], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `interior-design-${currentRoom}-${Date.now()}.json`;
        a.click();
        URL.revokeObjectURL(url);

        alert('Дизайн сохранен! Файл загружен на ваш компьютер.');
    }

    // Сброс дизайна
    function resetDesign() {
        if (confirm('Вы уверены, что хотите сбросить все настройки для всех комнат?')) {
            // Сброс состояния всех комнат
            currentState = {
                livingroom: { furniture: null, decor: null, chair: null, ceiling: null },
                kitchen: { furniture: null, chair: null, ceiling: null },
                bedroom: { furniture: null, decor: null, ceiling: null }
            };

            // Очистка всех зон
            clearAllZones();

            // Обновление интерфейса
            updateElementsGrid();
            document.getElementById('element-details').innerHTML = `
                    <h3>Выберите элемент</h3>
                    <p>Кликните на элемент слева для просмотра деталей</p>
                `;

            // Сохранение состояния
            saveState();

            alert('Дизайн сброшен для всех комнат!');
        }
    }

    // Отправка заявки
    function sendRequest() {
        const requestData = {
            room: currentRoom,
            roomName: roomConfig[currentRoom].name,
            elements: currentState[currentRoom],
            totalPrice: calculateTotalPrice(),
            timestamp: new Date().toISOString()
        };

        console.log('Отправка заявки:', requestData);

        // Форматируем данные для показа
        let elementsText = '';
        Object.keys(currentState[currentRoom]).forEach(category => {
            const elementId = currentState[currentRoom][category];
            if (elementId && elementsConfig[category] && elementsConfig[category][elementId]) {
                const element = elementsConfig[category][elementId];
                elementsText += `• ${getCategoryName(category)}: ${element.name} (${element.price.toLocaleString('ru-RU')} ₽)\n`;
            }
        });

        alert(`Заявка отправлена!\n\nКомната: ${roomConfig[currentRoom].name}\n\nВыбранные элементы:\n${elementsText || 'Ничего не выбрано'}\n\nОбщая стоимость: ${calculateTotalPrice().toLocaleString('ru-RU')} ₽`);
    }

    // Скачивание изображения
    function downloadImage() {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = 800;
        canvas.height = 600;

        // Заполняем фон
        ctx.fillStyle = '#f0f0f0';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Добавляем заголовок
        ctx.fillStyle = '#333';
        ctx.font = 'bold 24px Arial';
        ctx.fillText(`Дизайн интерьера - ${roomConfig[currentRoom].name}`, 20, 40);

        // Добавляем элементы
        ctx.font = '16px Arial';
        let y = 80;
        Object.keys(currentState[currentRoom]).forEach(category => {
            const elementId = currentState[currentRoom][category];
            if (elementId && elementsConfig[category] && elementsConfig[category][elementId]) {
                const element = elementsConfig[category][elementId];
                ctx.fillText(`${getCategoryName(category)}: ${element.name}`, 20, y);
                y += 25;
            }
        });

        // Добавляем цену
        ctx.font = 'bold 20px Arial';
        ctx.fillText(`Общая стоимость: ${calculateTotalPrice().toLocaleString('ru-RU')} ₽`, 20, y + 30);

        // Скачиваем изображение
        canvas.toBlob(function (blob) {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `interior-design-${currentRoom}-${Date.now()}.png`;
            a.click();
            URL.revokeObjectURL(url);
        });

        alert('Изображение сохранено!');
    }

    // Режим отладки для визуализации зон
    let debugMode = false;
    function toggleDebugMode() {
        debugMode = !debugMode;
        const zones = document.querySelectorAll('.zone');
        const button = event.target;

        if (debugMode) {
            zones.forEach(zone => zone.classList.add('debug'));
            button.textContent = '🔍 Скрыть зоны';
            button.style.background = 'linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%)';
        } else {
            zones.forEach(zone => zone.classList.remove('debug'));
            button.textContent = '🔍 Показать зоны';
            button.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
        }
    }

    // Функция для получения информации о текущем состоянии
    function getStateInfo() {
        return {
            currentRoom: currentRoom,
            currentCategory: currentCategory,
            roomState: currentState[currentRoom],
            totalPrice: calculateTotalPrice(),
            roomConfig: roomConfig[currentRoom]
        };
    }

    // Добавляем обработчик для клавиши F12 (режим разработчика)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'F12') {
            e.preventDefault();
            console.log('Состояние конструктора:', getStateInfo());
            toggleDebugMode();
        }
    });
</script>

