const canvas = new fabric.Canvas('c', { selection: false });


const base = wpData.templateUri;
const dirliv = `${base}/assets/cons/living`;
const dirkit = `${base}/assets/cons/kitchen`;
const dirbed = `${base}/assets/cons/bdroom`;
const direlem = `${base}/assets/cons/alem`;
console.log('Конструктор загружен!');

window.ROOMS = {
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
        background: `${dirbed}/bed_00.jpeg`,
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
            { id: 'diwan2', name: 'Стasdол', url: `${dirbed}/img6.webp`, x: 500, y: 420, w: 150, h: 100 },
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
            { id: 'diwan2', name: 'Диван', url: `${dirkit}/img2.webp`, x: 300, y: 350, w: 300, h: 180 },
            { id: 'shelf1', name: 'Шкаф', url: `${dirkit}/img3.webp`, x: 700, y: 300, w: 150, h: 220 }
        ]
    }
};

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

    const sendBtn = document.createElement('button');
    sendBtn.textContent = 'отправить';
    sendBtn.className = 'btn btn_sec openModalBtn';
    // sendBtn.id = 'openModalBtn';
    sendBtn.onclick = saveImage;
    buttonsDiv.appendChild(sendBtn);
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

function uploadCanvasAndSubmit() {
    const dataURL = canvas.toDataURL('image/png');
    const blob = dataURLToBlob(dataURL);
    const formData = new FormData();
    formData.append('canvas_image', blob, 'room.png');

    fetch(`${wpData.ajaxUrl}?action=upload_canvas`, {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.url) {
                document.querySelector('input[name="acf_image"]').value = data.url;
                document.querySelector('.wpcf7 form').submit();
            }
        })
        .catch(err => console.error('Ошибка при отправке canvas:', err));
}

function dataURLToBlob(dataURL) {
    const [header, base64] = dataURL.split(',');
    const byteString = atob(base64);
    const arrayBuffer = new ArrayBuffer(byteString.length);
    const intArray = new Uint8Array(arrayBuffer);
    for (let i = 0; i < byteString.length; i++) {
        intArray[i] = byteString.charCodeAt(i);
    }
    return new Blob([intArray], { type: 'image/png' });
}





// === Новая функция: загрузка canvas и подстановка в скрытое поле ===
function uploadAndAttachToForm() {
    return new Promise((resolve, reject) => {
        const dataURL = canvas.toDataURL('image/png');
        const blob = dataURLToBlob(dataURL);

        const formData = new FormData();
        formData.append('canvas_image', blob, `room-${currentRoom}-${Date.now()}.png`);

        fetch(`${wpData.ajaxUrl}?action=upload_canvas`, {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.data?.url) {
                    // Находим скрытое поле acf_image в форме CF7 и ставим туда URL
                    const acfImageInput = document.querySelector('input[name="acf_image"]');
                    if (acfImageInput) {
                        acfImageInput.value = data.data.url;
                    }
                    resolve(data.data.url);
                } else {
                    reject(new Error(data.data?.message || 'Upload failed'));
                }
            })
            .catch(err => {
                console.error('Ошибка загрузки canvas:', err);
                reject(err);
            });
    });
}

// === Перехват отправки формы CF7 ===
document.addEventListener('wpcf7submit', function (event) {
    // Не нужно — событие происходит ПОСЛЕ отправки.
    // Нам нужно ДО — используем `wpcf7beforesubmit`
});

// ✅ Важно: подключим событие ДО отправки
document.addEventListener('wpcf7beforesubmit', function (event) {
    const form = event.detail.contactForm;

    // Показываем лоадер или блокируем кнопку, если хочешь
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Сохраняю изображение...';
    }

    // Загружаем canvas и ждём
    event.preventDefault(); // ОТМЕНЯЕМ обычную отправку

    uploadAndAttachToForm()
        .then(url => {
            console.log('Canvas сохранён:', url);
            // Теперь вручную отправляем форму
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    // CF7 требует этих заголовков для AJAX-режима (если включён)
                    // Но проще — просто submit(), т.к. все поля уже заполнены
                }
            })
                .then(res => res.text()) // CF7 возвращает HTML ответ
                .then(html => {
                    // Имитируем стандартный ответ CF7
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const message = doc.querySelector('.wpcf7-response-output')?.textContent || 'Спасибо!';

                    // Показываем сообщение
                    const output = form.querySelector('.wpcf7-response-output');
                    if (output) {
                        output.style.display = 'block';
                        output.textContent = message;
                        output.className = 'wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ok';
                    }

                    // Если хочешь — перенаправить или сбросить
                })
                .catch(err => {
                    console.error('Ошибка отправки формы:', err);
                    const output = form.querySelector('.wpcf7-response-output');
                    if (output) {
                        output.style.display = 'block';
                        output.textContent = 'Ошибка при отправке. Попробуйте ещё раз.';
                        output.className = 'wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ng';
                    }
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Оставить заявку';
                    }
                });
        })
        .catch(err => {
            console.error('Не удалось загрузить изображение:', err);
            const output = form.querySelector('.wpcf7-response-output');
            if (output) {
                output.style.display = 'block';
                output.textContent = 'Не удалось сохранить изображение. Попробуйте ещё раз.';
                output.className = 'wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ng';
            }
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Оставить заявку';
            }
        });
});

