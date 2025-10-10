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

        .preview-container {
            position: relative;
            width: 100%;
            height: 500px;
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .preview-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: opacity 0.3s ease;
        }

        .preview-layer.hidden {
            opacity: 0;
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

        .price-display {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }

        .price-display h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .price-value {
            font-size: 32px;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏠 Конструктор отделки балкона</h1>
        <p>Выберите параметры отделки и визуализируйте результат</p>
    </div>

    <div class="constructor-container">
        <div class="panel left-panel">
            <div class="category">
                <div class="category-title">🪟 Остекление</div>
                <button class="option-button" data-category="glazing" data-option="warm">Тёплое</button>
                <button class="option-button" data-category="glazing" data-option="cold">Холодное</button>
                <button class="option-button" data-category="glazing" data-option="none">Без остекления</button>
            </div>

            <div class="category">
                <div class="category-title">🧱 Обшивка парапета</div>
                <button class="option-button" data-category="parapet" data-option="siding">Сайдинг</button>
                <button class="option-button" data-category="parapet" data-option="profile">Профлист</button>
                <button class="option-button" data-category="parapet" data-option="plastic">Пластик</button>
                <button class="option-button" data-category="parapet" data-option="none">Убрать</button>
            </div>

            <div class="category">
                <div class="category-title">🔥 Утепление</div>
                <button class="option-button" data-category="insulation" data-option="full">Полное</button>
                <button class="option-button" data-category="insulation" data-option="partial">Частичное</button>
                <button class="option-button" data-category="insulation" data-option="none">Без утепления</button>
            </div>

            <div class="category">
                <div class="category-title">💡 Освещение</div>
                <button class="option-button" data-category="lighting" data-option="ceiling">Потолочное</button>
                <button class="option-button" data-category="lighting" data-option="wall">Настенное</button>
                <button class="option-button" data-category="lighting" data-option="led">LED-подсветка</button>
                <button class="option-button" data-category="lighting" data-option="none">Убрать</button>
            </div>
        </div>

        <div class="panel center-panel">
            <div class="preview-container">
                <div class="loading">Загрузка...</div>
                <div class="preview-layer" id="base-layer"></div>
                <div class="preview-layer" id="glazing-layer"></div>
                <div class="preview-layer" id="parapet-layer"></div>
                <div class="preview-layer" id="walls-layer"></div>
                <div class="preview-layer" id="floor-layer"></div>
                <div class="preview-layer" id="ceiling-layer"></div>
                <div class="preview-layer" id="furniture-layer"></div>
                <div class="preview-layer" id="lighting-layer"></div>
                <div class="preview-layer" id="decor-layer"></div>
            </div>

            <div class="controls">
                <button class="control-button" onclick="saveDesign()">💾 Сохранить дизайн</button>
                <button class="control-button" onclick="resetDesign()">🔄 Сбросить всё</button>
                <button class="control-button" onclick="sendRequest()">📧 Отправить заявку</button>
                <button class="control-button" onclick="downloadImage()">📸 Скачать изображение</button>
            </div>

            <div class="price-display">
                <h3>Примерная стоимость:</h3>
                <div class="price-value" id="total-price">0 ₽</div>
            </div>
        </div>

        <div class="panel right-panel">
            <div class="category">
                <div class="category-title">🎨 Отделка стен</div>
                <button class="option-button" data-category="walls" data-option="gypsum">Гипсокартон</button>
                <button class="option-button" data-category="walls" data-option="pvc">ПВХ панели</button>
                <button class="option-button" data-category="walls" data-option="lining">Вагонка</button>
                <button class="option-button" data-category="walls" data-option="paint">Покраска</button>
                <button class="option-button" data-category="walls" data-option="none">Убрать</button>
            </div>

            <div class="category">
                <div class="category-title">🏠 Отделка пола</div>
                <button class="option-button" data-category="floor" data-option="laminate">Ламинат</button>
                <button class="option-button" data-category="floor" data-option="tile">Плитка</button>
                <button class="option-button" data-category="floor" data-option="linoleum">Линолеум</button>
                <button class="option-button" data-category="floor" data-option="carpet">Ковролин</button>
                <button class="option-button" data-category="floor" data-option="none">Убрать</button>
            </div>

            <div class="category">
                <div class="category-title">☁️ Отделка потолка</div>
                <button class="option-button" data-category="ceiling" data-option="stretch">Натяжной</button>
                <button class="option-button" data-category="ceiling" data-option="gypsum">Гипсокартон</button>
                <button class="option-button" data-category="ceiling" data-option="panels">Панели</button>
                <button class="option-button" data-category="ceiling" data-option="none">Убрать</button>
            </div>

            <div class="category">
                <div class="category-title">🪑 Мебель</div>
                <button class="option-button" data-category="furniture" data-option="wardrobe">Шкаф</button>
                <button class="option-button" data-category="furniture" data-option="dresser">Тумба</button>
                <button class="option-button" data-category="furniture" data-option="table">Стол</button>
                <button class="option-button" data-category="furniture" data-option="shelves">Полки</button>
                <button class="option-button" data-category="furniture" data-option="none">Убрать</button>
            </div>
        </div>
    </div>

    <script>
        // Конфигурация изображений с использованием демо-источников
        const imageConfig = {
            base: 'https://images.unsplash.com/photo-1616628188598-6b387a2c97c7?auto=format&fit=crop&w=800&q=80',
            categories: {
                glazing: {
                    warm: 'https://images.unsplash.com/photo-1598300054086-ec7f3e384b93?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    cold: 'https://images.unsplash.com/photo-1560184897-90d3f86e7e7a?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                },
                parapet: {
                    siding: 'https://images.unsplash.com/photo-1597003727493-6d3b8f1c9301?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    profile: 'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    plastic: 'https://images.unsplash.com/photo-1616047007936-4c7a6289323e?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                },
                walls: {
                    gypsum: 'https://images.unsplash.com/photo-1595526114035-6f740d1a28a4?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    pvc: 'https://images.unsplash.com/photo-1616047007936-4c7a6289323e?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    lining: 'https://images.unsplash.com/photo-1598928506311-c55ded3f3d47?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    paint: 'https://images.unsplash.com/photo-1562113530-57ba467cea38?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                },
                floor: {
                    laminate: 'https://images.unsplash.com/photo-1598300053727-df6f5a7a7cb0?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    tile: 'https://images.unsplash.com/photo-1587202372616-0137b1c4bba6?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    linoleum: 'https://images.unsplash.com/photo-1600522327918-9023b2b4df94?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    carpet: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                },
                ceiling: {
                    stretch: 'https://images.unsplash.com/photo-1565183928294-7d21b36c9c24?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    gypsum: 'https://images.unsplash.com/photo-1595526114035-6f740d1a28a4?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    panels: 'https://images.unsplash.com/photo-1616047007936-4c7a6289323e?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                },
                furniture: {
                    wardrobe: 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118b?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    dresser: 'https://images.unsplash.com/photo-1601043564917-02e2b26f4f8c?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    table: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    shelves: 'https://images.unsplash.com/photo-1594736797933-d0501ba2fe65?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                },
                insulation: {
                    full: '',
                    partial: '',
                    none: ''
                },
                lighting: {
                    ceiling: 'https://images.unsplash.com/photo-1524634126442-357e0eac3c14?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    wall: 'https://images.unsplash.com/photo-1540932239986-30128078f3c5?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    led: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                },
                decor: {
                    plants: 'https://images.unsplash.com/photo-1493957988430-a5f2e15f39a3?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    curtains: 'https://images.unsplash.com/photo-1584132915807-fd1f5fbc078f?auto=format&fit=crop&w=800&q=80&blend=FFFFFF&blend-alpha=30',
                    none: ''
                }
            }
        };

        // Примерные цены для расчета стоимости
        const prices = {
            glazing: { warm: 45000, cold: 25000, none: 0 },
            parapet: { siding: 15000, profile: 12000, plastic: 10000, none: 0 },
            walls: { gypsum: 20000, pvc: 15000, lining: 25000, paint: 10000, none: 0 },
            floor: { laminate: 18000, tile: 22000, linoleum: 12000, carpet: 15000, none: 0 },
            ceiling: { stretch: 20000, gypsum: 18000, panels: 15000, none: 0 },
            furniture: { wardrobe: 35000, dresser: 15000, table: 10000, shelves: 8000, none: 0 },
            insulation: { full: 25000, partial: 15000, none: 0 },
            lighting: { ceiling: 8000, wall: 6000, led: 12000, none: 0 }
        };

        // Текущее состояние конструктора
        let currentState = {
            glazing: null,
            parapet: null,
            walls: null,
            floor: null,
            ceiling: null,
            furniture: null,
            insulation: null,
            lighting: null,
            decor: null
        };

        // Инициализация
        document.addEventListener('DOMContentLoaded', function() {
            loadState();
            initializeBaseLayer();
            attachEventListeners();
            updatePrice();
            hideLoading();
        });

        // Загрузка состояния из localStorage
        function loadState() {
            const savedState = localStorage.getItem('balconyDesign');
            if (savedState) {
                currentState = JSON.parse(savedState);
                applyState();
            }
        }

        // Сохранение состояния в localStorage
        function saveState() {
            localStorage.setItem('balconyDesign', JSON.stringify(currentState));
        }

        // Применение сохраненного состояния
        function applyState() {
            Object.keys(currentState).forEach(category => {
                if (currentState[category]) {
                    const button = document.querySelector(`[data-category="${category}"][data-option="${currentState[category]}"]`);
                    if (button) {
                        selectOption(category, currentState[category], button);
                    }
                }
            });
        }

        // Инициализация базового слоя
        function initializeBaseLayer() {
            const baseLayer = document.getElementById('base-layer');
            baseLayer.style.backgroundImage = `url('${imageConfig.base}')`;
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
            const buttons = document.querySelectorAll('.option-button');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;
                    const option = this.dataset.option;
                    selectOption(category, option, this);
                });
            });
        }

        // Выбор опции
        function selectOption(category, option, button) {
            // Обновление активной кнопки
            const categoryButtons = document.querySelectorAll(`[data-category="${category}"]`);
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Обновление состояния
            currentState[category] = option === 'none' ? null : option;

            // Обновление слоя
            updateLayer(category, option);

            // Сохранение состояния
            saveState();

            // Обновление цены
            updatePrice();
        }

        // Обновление слоя
        function updateLayer(category, option) {
            const layerId = `${category}-layer`;
            const layer = document.getElementById(layerId);
            
            if (!layer) return;

            if (option === 'none' || !imageConfig.categories[category] || !imageConfig.categories[category][option]) {
                layer.classList.add('hidden');
            } else {
                const imageUrl = imageConfig.categories[category][option];
                if (imageUrl) {
                    layer.style.backgroundImage = `url('${imageUrl}')`;
                    layer.classList.remove('hidden');
                }
            }
        }

        // Расчет и обновление цены
        function updatePrice() {
            let totalPrice = 0;
            
            Object.keys(currentState).forEach(category => {
                if (currentState[category] && prices[category] && prices[category][currentState[category]]) {
                    totalPrice += prices[category][currentState[category]];
                }
            });

            const priceElement = document.getElementById('total-price');
            if (priceElement) {
                priceElement.textContent = totalPrice.toLocaleString('ru-RU') + ' ₽';
            }
        }

        // Сохранение дизайна
        function saveDesign() {
            const designData = {
                timestamp: new Date().toISOString(),
                state: currentState,
                price: calculateTotalPrice()
            };
            
            const blob = new Blob([JSON.stringify(designData, null, 2)], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `balcony-design-${Date.now()}.json`;
            a.click();
            URL.revokeObjectURL(url);
            
            alert('Дизайн сохранен! Файл загружен на ваш компьютер.');
        }

        // Расчет общей цены
        function calculateTotalPrice() {
            let total = 0;
            Object.keys(currentState).forEach(category => {
                if (currentState[category] && prices[category] && prices[category][currentState[category]]) {
                    total += prices[category][currentState[category]];
                }
            });
            return total;
        }

        // Сброс дизайна
        function resetDesign() {
            if (confirm('Вы уверены, что хотите сбросить все настройки?')) {
                // Сброс состояния
                Object.keys(currentState).forEach(key => {
                    currentState[key] = null;
                });

                // Скрытие всех слоев кроме базового
                const layers = document.querySelectorAll('.preview-layer:not(#base-layer)');
                layers.forEach(layer => layer.classList.add('hidden'));

                // Снятие активности с кнопок
                const buttons = document.querySelectorAll('.option-button');
                buttons.forEach(button => button.classList.remove('active'));

                // Сохранение и обновление
                saveState();
                updatePrice();
                
                alert('Дизайн сброшен!');
            }
        }

        // Отправка заявки
        function sendRequest() {
            const requestData = {
                design: currentState,
                price: calculateTotalPrice(),
                timestamp: new Date().toISOString()
            };

            // Здесь можно добавить реальную отправку на сервер
            console.log('Отправка заявки:', requestData);
            
            // Для демо показываем alert
            alert(`Заявка отправлена!\n\nВыбранные опции:\n${formatRequestData(currentState)}\n\nПримерная стоимость: ${calculateTotalPrice().toLocaleString('ru-RU')} ₽`);
        }

        // Форматирование данных заявки
        function formatRequestData(state) {
            const labels = {
                glazing: 'Остекление',
                parapet: 'Обшивка парапета',
                walls: 'Отделка стен',
                floor: 'Отделка пола',
                ceiling: 'Отделка потолка',
                furniture: 'Мебель',
                insulation: 'Утепление',
                lighting: 'Освещение'
            };

            const optionLabels = {
                warm: 'Тёплое',
                cold: 'Холодное',
                siding: 'Сайдинг',
                profile: 'Профлист',
                plastic: 'Пластик',
                gypsum: 'Гипсокартон',
                pvc: 'ПВХ панели',
                lining: 'Вагонка',
                paint: 'Покраска',
                laminate: 'Ламинат',
                tile: 'Плитка',
                linoleum: 'Линолеум',
                carpet: 'Ковролин',
                stretch: 'Натяжной',
                panels: 'Панели',
                wardrobe: 'Шкаф',
                dresser: 'Тумба',
                table: 'Стол',
                shelves: 'Полки',
                full: 'Полное',
                partial: 'Частичное',
                ceiling: 'Потолочное',
                wall: 'Настенное',
                led: 'LED-подсветка'
            };

            let result = [];
            Object.keys(state).forEach(category => {
                if (state[category] && labels[category]) {
                    const optionLabel = optionLabels[state[category]] || state[category];
                    result.push(`• ${labels[category]}: ${optionLabel}`);
                }
            });

            return result.join('\n') || 'Ничего не выбрано';
        }

        // Скачивание изображения (упрощенная версия)
        function downloadImage() {
            // Создаем canvas для рендеринга
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const previewContainer = document.querySelector('.preview-container');
            
            canvas.width = 800;
            canvas.height = 500;
            
            // Заполняем фон
            ctx.fillStyle = '#f0f0f0';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Добавляем текст с выбранными опциями
            ctx.fillStyle = '#333';
            ctx.font = '20px Arial';
            ctx.fillText('Конструктор балкона - Ваш дизайн', 20, 40);
            
            ctx.font = '14px Arial';
            let y = 80;
            Object.keys(currentState).forEach(category => {
                if (currentState[category]) {
                    ctx.fillText(`${category}: ${currentState[category]}`, 20, y);
                    y += 25;
                }
            });
            
            // Добавляем цену
            ctx.font = 'bold 18px Arial';
            ctx.fillText(`Стоимость: ${calculateTotalPrice().toLocaleString('ru-RU')} ₽`, 20, y + 20);
            
            // Скачиваем изображение
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `balcony-design-${Date.now()}.png`;
                a.click();
                URL.revokeObjectURL(url);
            });
            
            alert('Изображение сохранено!');
        }

        // Обработка изменения размера окна
        window.addEventListener('resize', function() {
            // Можно добавить адаптивную логику
        });

        // Предзагрузка изображений для улучшения производительности
        function preloadImages() {
            const images = [];
            
            // Собираем все URL изображений
            Object.values(imageConfig.categories).forEach(category => {
                Object.values(category).forEach(url => {
                    if (url) images.push(url);
                });
            });
            
            // Предзагружаем
            images.forEach(url => {
                const img = new Image();
                img.src = url;
            });
        }

        // Запускаем предзагрузку после загрузки страницы
        setTimeout(preloadImages, 1000);
    </script>
</body>
</html>