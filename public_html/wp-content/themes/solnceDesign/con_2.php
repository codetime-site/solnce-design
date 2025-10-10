<?php 
// Template Name: Конструктор
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Конструктор отделки балкона</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .constructor-container {
            flex: 1;
            display: flex;
            gap: 20px;
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow-y: auto;
            max-height: calc(100vh - 140px);
        }

        .left-panel, .right-panel {
            flex: 0 0 250px;
        }

        .center-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .scene-container {
            position: relative;
            width: 100%;
            height: 500px;
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .scene-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: all 0.5s ease;
        }

        /* Стили для селекторов комнат и категорий */
        .room-selector, .category-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .room-button, .category-button {
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #333;
            position: relative;
            z-index: 100;
            pointer-events: auto;
        }

        .room-button:hover, .category-button:hover {
            background: #f5f5f5;
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .room-button.active, .category-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
        }

        .category-button.hidden {
            display: none;
        }

        /* Стили для сетки элементов */
        .elements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            padding: 20px 0;
        }

        .element-item {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .element-item:hover {
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .element-item.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .element-thumbnail {
            width: 80px;
            height: 60px;
            background-size: cover;
            background-position: center;
            border-radius: 5px;
            margin: 0 auto 8px;
            background-color: #f0f0f0;
        }

        .element-name {
            font-size: 12px;
            font-weight: 600;
        }

        /* Информация о комнате */
        .room-info {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }

        .room-info h3 {
            color: #333;
            margin-bottom: 5px;
            font-size: 18px;
        }

        .room-info p {
            color: #666;
            font-size: 14px;
        }

        /* Детали элемента */
        .element-details {
            background: white;
            padding: 20px;
            border-radius: 10px;
            height: fit-content;
        }

        .element-details h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .element-details p {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .category {
            margin-bottom: 25px;
        }

        .category-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #667eea;
        }

        .option-button {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 8px;
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #333;
            text-align: left;
        }

        .option-button:hover {
            background: #f5f5f5;
            border-color: #667eea;
            transform: translateX(5px);
        }

        .option-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
        }

        .controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .control-button {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .control-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            color: #666;
        }

        @media (max-width: 768px) {
            .constructor-container {
                flex-direction: column;
            }

            .left-panel, .right-panel {
                flex: none;
                width: 100%;
                max-height: 300px;
            }

            .preview-container {
                height: 300px;
            }
        }


        /* Стили для зон размещения элементов */
        .zone {
            position: absolute;
            pointer-events: none;
        }

        .floor-zone {
            bottom: 10%;
            left: 20%;
            width: 60%;
            height: 30%;
            z-index: 10;
        }

        .wall-zone {
            top: 20%;
            left: 15%;
            width: 70%;
            height: 50%;
            z-index: 8;
        }

        .ceiling-zone {
            top: 5%;
            left: 25%;
            width: 50%;
            height: 20%;
            z-index: 12;
        }

        .window-zone {
            top: 15%;
            right: 10%;
            width: 25%;
            height: 40%;
            z-index: 9;
        }

        .zone-element {
            position: absolute;
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        .fade-out {
            animation: fadeOut 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.9); }
        }

        /* Отладочные границы зон (можно убрать в продакшене) */
        .zone.debug {
            border: 2px dashed rgba(255, 0, 0, 0.3);
            background: rgba(255, 0, 0, 0.1);
        }

        /* Стили для формы загрузки фото */
        .photo-upload-form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border: 2px solid #667eea;
        }

        .photo-upload-form h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .photo-upload-form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
        }

        /* Стили для формы сброса */
        .reset-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
        }

        .reset-container {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
        }

        .reset-container h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .reset-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .reset-button {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .reset-button.danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        }

        .reset-button.danger:hover {
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
    </style>
</head>
<body>
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

    <script>
        // Конфигурация комнат и элементов
        var dirUri = "<?php echo get_template_directory_uri(); ?>";

        // Конфигурация комнат с фоновыми изображениями
        const roomConfig = {
            livingroom: {
                name: 'Гостиная',
                background: 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80',
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
                background: 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=800&q=80',
                categories: ['furniture', 'chair', 'ceiling'], // декор скрыт
                zones: {
                    furniture: { bottom: '40px', left: '200px', width: '180px', height: '140px' },
                    chair: { bottom: '40px', right: '150px', width: '100px', height: '100px' },
                    ceiling: { top: '30px', left: '50%', transform: 'translateX(-50%)', width: '100px', height: '80px' }
                }
            },
            bedroom: {
                name: 'Спальня',
                background: 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80',
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
        document.addEventListener('DOMContentLoaded', function() {
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
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const room = this.dataset.room;
                    switchRoom(room);
                });
            });

            // Обработчики для кнопок категорий
            const categoryButtons = document.querySelectorAll('.category-button');
            categoryButtons.forEach(button => {
                button.addEventListener('click', function(e) {
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
            
            item.addEventListener('click', function() {
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
            img.onerror = function() {
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
            canvas.toBlob(function(blob) {
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
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12') {
                e.preventDefault();
                console.log('Состояние конструктора:', getStateInfo());
                toggleDebugMode();
            }
        });
    </script>
</body>
</html>
