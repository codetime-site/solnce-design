<?php
// Обработка формы конструктора для отправки в AmoCRM
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['your-phone'])) {
    $name = sanitize_text_field($_POST['your-name'] ?? '');
    $phone = sanitize_text_field($_POST['your-phone']);
    $email = sanitize_email($_POST['your-email'] ?? '');
    $product_url = get_permalink(); // Ссылка на страницу конструктора

    if ($phone) {
        $res = amocrm_create_lead_with_contact($name ?: 'Без имени', $phone, $email, $product_url);
        if (is_wp_error($res)) {
            error_log('amoCRM error from constructor: ' . $res->get_error_message());
        } else {
            error_log('amoCRM create lead response from constructor: ' . print_r($res, true));
        }
        // Можно добавить сообщение пользователю, но пока просто логируем
    }
}
?>

<main id="main" class="main">
    <div class="container">
        <!-- Онлайн-конструктор интерьера -->
        <div class="interior-constructor">
            <div class="constructor-header">
                <h1>Онлайн-конструктор интерьера</h1>
                <p>Создайте дизайн своей мечты прямо на сайте</p>
            </div>

            <div class="constructor-controls">
                <div class="room-selector">
                    <label for="room-select">Выберите тип комнаты:</label>
                    <select id="room-select">
                        <option value="living">Гостиная</option>
                        <option value="kitchen">Кухня</option>
                        <option value="bedroom">Спальня</option>
                        <option value="bathroom">Ванная</option>
                        <option value="office">Кабинет</option>
                    </select>
                </div>
            </div>

            <div class="constructor-main">
                <div class="elements-panel">
                    <div class="element-category">
                        <h3>Потолки</h3>
                        <div class="elements-list" id="ceilings">
                            <div class="element-item" data-type="ceiling" data-style="stretch" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Кессоновый потолок/Кессоновый потолок.png" alt="Кессоновый потолок">
                                <span>Кессоновый</span>
                            </div>
                            <div class="element-item" data-type="ceiling" data-style="gypsum" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Парящий потолок/Парящий потолок.png" alt="Парящий потолок">
                                <span>Парящий</span>
                            </div>
                            <div class="element-item" data-type="ceiling" data-style="shadow" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Потолок теневой/Потолок с теневым зазором.png" alt="Теневой потолок">
                                <span>Теневой</span>
                            </div>
                            <div class="element-item" data-type="ceiling" data-style="light" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Световой потолок/Световой потолок .png" alt="Световой потолок">
                                <span>Световой</span>
                            </div>
                        </div>
                    </div>

                    <div class="element-category">
                        <h3>Освещение</h3>
                        <div class="elements-list" id="lights">
                            <div class="element-item" data-type="light" data-style="chandelier" data-color="gold" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Люстра/Люстра.png" alt="Люстра">
                                <span>Люстра</span>
                            </div>
                            <div class="element-item" data-type="light" data-style="spotlight" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Встраиваемые точки/Встраеваемый точечный светильник.png" alt="Встраиваемый светильник">
                                <span>Встраиваемый</span>
                            </div>
                            <div class="element-item" data-type="light" data-style="surface" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Накладные точки/Накладной точечный светильник.png" alt="Накладной светильник">
                                <span>Накладной</span>
                            </div>
                            <div class="element-item" data-type="light" data-style="track" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Трековое освещение/Трековое освещение.png" alt="Трековое освещение">
                                <span>Трековое</span>
                            </div>
                            <div class="element-item" data-type="light" data-style="strings" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Струны/Струны.png" alt="Струны">
                                <span>Струны</span>
                            </div>
                        </div>
                    </div>

                    <div class="element-category">
                        <h3>Мебель</h3>
                        <div class="elements-list" id="furniture">
                            <div class="element-item" data-type="furniture" data-style="sofa" data-color="gray" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Диван.png" alt="Диван">
                                <span>Диван</span>
                            </div>
                            <div class="element-item" data-type="furniture" data-style="table" data-color="brown" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Стол.png" alt="Стол">
                                <span>Стол</span>
                            </div>
                            <div class="element-item" data-type="furniture" data-style="chair" data-color="brown" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Стул.png" alt="Стул">
                                <span>Стул</span>
                            </div>
                            <div class="element-item" data-type="furniture" data-style="bed" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Кровать.png" alt="Кровать">
                                <span>Кровать</span>
                            </div>
                            <div class="element-item" data-type="furniture" data-style="armchair" data-color="gray" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Кресло.png" alt="Кресло">
                                <span>Кресло</span>
                            </div>
                        </div>
                    </div>

                    <div class="element-category">
                        <h3>Декор</h3>
                        <div class="elements-list" id="decor">
                            <div class="element-item" data-type="decor" data-style="picture" data-color="frame" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Картина.png" alt="Картина">
                                <span>Картина</span>
                            </div>
                            <div class="element-item" data-type="decor" data-style="plant" data-color="green" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Растение.png" alt="Растение">
                                <span>Растение</span>
                            </div>
                            <div class="element-item" data-type="decor" data-style="vase" data-color="white" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Ваза.png" alt="Ваза">
                                <span>Ваза</span>
                            </div>
                            <div class="element-item" data-type="decor" data-style="pouf" data-color="gray" draggable="true">
                                <img src="<?php echo get_template_directory_uri(); ?>/construct/Мебель и декор/Пуф.png" alt="Пуф">
                                <span>Пуф</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="view-area">
                    <div class="view-container">
                        <div class="view-2d active" id="view-2d">
                            <div class="room-canvas" id="room-canvas">
                                <!-- Elements will be dropped here -->
                            </div>
                        </div>
                    </div>

                    <div class="element-controls" id="element-controls" style="display: none;">
                        <h4>Настройки элемента</h4>
                        <div class="control-group">
                            <label>Цвет:</label>
                            <input type="color" id="element-color">
                        </div>
                        <div class="control-group">
                            <label>Размер:</label>
                            <input type="range" id="element-size" min="50" max="200" value="100">
                        </div>
                        <button id="remove-element">Удалить</button>
                    </div>
                </div>
            </div>

            <div class="constructor-actions">
                <button id="reset-design">Сбросить дизайн</button>
                <button id="save-design">Сохранить и отправить подборку</button>
            </div>

            <div class="constructor-cta">
                <p>Создайте свой идеальный интерьер — мы воплотим его в реальность!</p>
            </div>
        </div>
    </div>
</main>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Interior Constructor JavaScript
        const roomCanvas = document.getElementById('room-canvas');
        const elementItems = document.querySelectorAll('.element-item');
        const elementControls = document.getElementById('element-controls');
        const elementColor = document.getElementById('element-color');
        const elementSize = document.getElementById('element-size');
        const removeElement = document.getElementById('remove-element');
        const resetDesign = document.getElementById('reset-design');
        const saveDesign = document.getElementById('save-design');
        const roomSelect = document.getElementById('room-select');

        let selectedElement = null;
        let placedElements = [];

        // Room selector
        roomSelect.addEventListener('change', function () {
            const room = this.value;
            // Change background image based on room
            const backgroundImages = {
                living: 'url(https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=600&fit=crop)',
                kitchen: 'url(https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop)',
                bedroom: 'url(https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=800&h=600&fit=crop)',
                bathroom: 'url(https://images.unsplash.com/photo-1552321554-5fefe8bfef14?w=800&h=600&fit=crop)',
                office: 'url(https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&h=600&fit=crop)'
            };
            const backgroundImage = backgroundImages[room] || 'none';
            roomCanvas.style.backgroundImage = backgroundImage;
            roomCanvas.style.backgroundSize = 'cover';
            roomCanvas.style.backgroundPosition = 'center';
            roomCanvas.style.backgroundRepeat = 'no-repeat';
        });

        // Drag and drop
        elementItems.forEach(item => {
            item.addEventListener('dragstart', function (e) {
                e.dataTransfer.setData('text/plain', JSON.stringify({
                    type: this.dataset.type,
                    style: this.dataset.style,
                    color: this.dataset.color,
                    img: this.querySelector('img').src,
                    name: this.querySelector('span').textContent
                }));
            });
        });

        roomCanvas.addEventListener('dragover', function (e) {
            e.preventDefault();
        });

        roomCanvas.addEventListener('drop', function (e) {
            e.preventDefault();
            const data = JSON.parse(e.dataTransfer.getData('text/plain'));
            const rect = roomCanvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const elementDiv = document.createElement('div');
            elementDiv.className = 'placed-element';
            elementDiv.style.position = 'absolute';
            elementDiv.style.left = x + 'px';
            elementDiv.style.top = y + 'px';
            elementDiv.style.width = '50px';
            elementDiv.style.height = '50px';
            elementDiv.style.background = 'transparent';
            elementDiv.style.border = '1px solid #ccc';
            elementDiv.style.cursor = 'pointer';
            elementDiv.innerHTML = `<img src="${data.img}" style="width:100%; height:100%; object-fit:contain;">`;

            elementDiv.dataset.type = data.type;
            elementDiv.dataset.style = data.style;
            elementDiv.dataset.color = data.color;
            elementDiv.dataset.name = data.name;

            elementDiv.addEventListener('click', function () {
                selectElement(this);
            });

            // Make placed element draggable
            makeDraggable(elementDiv);

            roomCanvas.appendChild(elementDiv);
            placedElements.push(elementDiv);
        });


        function makeDraggable(element) {
            let isDragging = false;
            let startX, startY, initialX, initialY;

            element.addEventListener('mousedown', function(e) {
                isDragging = true;
                startX = e.clientX;
                startY = e.clientY;
                initialX = element.offsetLeft;
                initialY = element.offsetTop;
                element.style.cursor = 'grabbing';
                e.preventDefault();
            });

            document.addEventListener('mousemove', function(e) {
                if (!isDragging) return;

                const dx = e.clientX - startX;
                const dy = e.clientY - startY;

                element.style.left = (initialX + dx) + 'px';
                element.style.top = (initialY + dy) + 'px';
            });

            document.addEventListener('mouseup', function() {
                if (isDragging) {
                    isDragging = false;
                    element.style.cursor = 'pointer';
                }
            });
        }

        function selectElement(element) {
            if (selectedElement) {
                selectedElement.style.border = '1px solid #ccc';
            }
            selectedElement = element;
            element.style.border = '2px solid #667eea';
            elementControls.style.display = 'block';

            elementColor.value = element.dataset.color;
            elementSize.value = parseInt(element.style.width) || 50;
        }

        elementColor.addEventListener('input', function () {
            if (selectedElement) {
                selectedElement.style.background = this.value;
                selectedElement.dataset.color = this.value;
            }
        });

        elementSize.addEventListener('input', function () {
            if (selectedElement) {
                const size = this.value + 'px';
                selectedElement.style.width = size;
                selectedElement.style.height = size;
            }
        });

        removeElement.addEventListener('click', function () {
            if (selectedElement) {
                roomCanvas.removeChild(selectedElement);
                // Also remove from 3D
                const index = placedElements.indexOf(selectedElement);
                if (index > -1) {
                    placedElements.splice(index, 1);
                }
                selectedElement = null;
                elementControls.style.display = 'none';
            }
        });

        // Reset design
        resetDesign.addEventListener('click', function () {
            // Remove all placed elements
            placedElements.forEach(element => {
                if (element.parentNode) {
                    element.parentNode.removeChild(element);
                }
            });
            placedElements = [];
            selectedElement = null;
            elementControls.style.display = 'none';
        });

        // Save design
        saveDesign.addEventListener('click', function () {
            const design = {
                room: roomSelect.value,
                elements: placedElements.map(el => ({
                    type: el.dataset.type,
                    style: el.dataset.style,
                    color: el.dataset.color,
                    name: el.dataset.name,
                    x: el.style.left,
                    y: el.style.top,
                    size: el.style.width
                }))
            };

            // Create form modal or section
            const formSection = document.createElement('div');
            formSection.id = 'design-form';
            formSection.innerHTML = `
                <div style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000; display:flex; align-items:center; justify-content:center;">
                    <div style="background:white; padding:20px; border-radius:10px; max-width:500px; width:90%;">
                        <h3>Отправить подборку</h3>
                        <form>
                            <input type="hidden" name="design_data" value='${JSON.stringify(design)}'>
                            <div style="margin-bottom:10px;">
                                <label>Имя:</label>
                                <input type="text" name="your-name" placeholder="Ваше имя" required style="width:100%; padding:8px;">
                            </div>
                            <div style="margin-bottom:10px;">
                                <label>Телефон:</label>
                                <input type="tel" name="your-phone" placeholder="Ваш телефон" required style="width:100%; padding:8px;">
                            </div>
                            <div style="margin-bottom:10px;">
                                <label>Email:</label>
                                <input type="email" name="your-email" placeholder="Ваш email" required style="width:100%; padding:8px;">
                            </div>
                            <div style="margin-bottom:10px;">
                                <label>Комментарий:</label>
                                <textarea name="your-message" style="width:100%; padding:8px; height:80px;"></textarea>
                            </div>
                            <button type="submit" style="padding:10px 20px; background:#667eea; color:white; border:none; border-radius:5px;">Отправить</button>
                            <button type="button" onclick="document.getElementById('design-form').remove();" style="padding:10px 20px; background:#ccc; color:black; border:none; border-radius:5px; margin-left:10px;">Отмена</button>
                        </form>
                    </div>
                </div>
            `;
            document.body.appendChild(formSection);
        });
    });
</script>
