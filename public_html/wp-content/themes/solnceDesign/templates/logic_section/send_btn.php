<?php
$layout = get_row_layout();
if ($layout) {
    switch ($layout) {
        case 'video':
            $repeater = 'rep_video';
            break;
        case 'worker':
            $repeater = 'rep_wokr';
            break;
        case 'reviews':
            $repeater = 'rep_win';
            break;
        case 'contact':
            $repeater = 'rep_adress';
            break;
        default:
            $repeater = 'rep_step';
            break;
    }
}

$btn = get_sub_field('btn');
?>

<?php if ($layout && $layout == "hero"): ?>
    <?php if ($btn): ?>
        <button class="btn btn_sec" id="openModalBtn">
            <?php echo esc_html($btn) ?>
            <i class="fontello-arrows-right-line1"></i>
        </button>
    <?php endif; ?>
<?php endif; ?>



<!-- 
<div id="myModal" class="modal-backdrop">
    <div class="modal-content">
        <span class="close-btn">&times;</span>

        <h2>Оставьте свою заявку</h2>

        <form>
            <input type="text" placeholder="Ваше имя">
            <input type="email" placeholder="Ваш Email">
            <textarea placeholder="Сообщение"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>
</div> -->
<!--
<style>
    /* Основные стили для модального окна (Без изменений, кроме flex/display) */
.modal-backdrop {
    display: none; 
    position: fixed; 
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7); 
    /* !!! ВАЖНО: Убираем 'display: flex' отсюда, будем контролировать его JS-классом */
    justify-content: center;
    align-items: center;
    /* Убедимся, что фон плавно появляется */
    transition: opacity 0.3s ease-out; 
    opacity: 0; /* Изначально полностью прозрачно */
}

/* Стили для контента внутри модального окна */
.modal-content {
    background-color: #fefefe;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    position: relative;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    
    /* Добавляем плавный переход для трансформации (движения) */
    transition: transform 0.3s ease-out; 
    /* Изначальное положение: сдвинуто вверх (или вниз) и уменьшено */
    transform: translateY(-50px) scale(0.95); 
}

/* ------------------------------------------- */
/* НОВЫЕ КЛАССЫ ДЛЯ АНИМАЦИИ ВЫХОДА/ПОЯВЛЕНИЯ */
/* ------------------------------------------- */

/* Класс, который JS добавит для отображения окна */
.modal-show {
    display: flex; /* Делаем видимым */
    opacity: 1;    /* Делаем полностью непрозрачным */
}

/* Класс, который JS добавит, чтобы контент занял финальное положение */
.modal-show .modal-content {
    transform: translateY(0) scale(1); /* Возвращаем в центр и 100% размер */
}

/* Основные стили для модального окна */
.modal-backdrop {
    /* Скрыто по умолчанию */
    display: none; 
    /* Фиксированное положение на весь экран */
    position: fixed; 
    z-index: 1000; /* Поверх всего контента */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    /* Полупрозрачный черный фон */
    background-color: rgba(0,0,0,0.7); 
    /* Центрирование контента */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Стили для контента внутри модального окна */
.modal-content {
    background-color: #fefefe;
    padding: 20px;
    border-radius: 8px;
    width: 90%; /* Ширина на мобильных */
    max-width: 400px; /* Максимальная ширина */
    position: relative;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
}

/* Стили для кнопки закрытия */
.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-btn:hover,
.close-btn:focus {
    color: #333;
    text-decoration: none;
    cursor: pointer;
}

/* Дополнительные стили для формы внутри (по желанию) */
.modal-content input, 
.modal-content textarea {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.modal-content button[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Получаем элементы
    const modal = document.getElementById('myModal');
    const btn = document.getElementById('openModalBtn');
    const closeBtn = document.querySelector('.close-btn');

    // Функция открытия модального окна (добавляем класс)
    btn.onclick = function() {
        // Сначала делаем модалку "видимой" (display: flex), но еще прозрачной
        modal.style.display = "flex"; 
        
        // Добавляем задержку 50мс, чтобы браузер успел отрисовать 'display: flex',
        // прежде чем применить opacity: 1 и transform: translateY(0). 
        // Это инициирует плавную CSS-анимацию.
        setTimeout(() => {
            modal.classList.add('modal-show');
        }, 50);
    }

    // Функция закрытия при клике на крестик или фон
    function closeModal() {
        // Убираем класс, который запускает анимацию закрытия (обратная анимация)
        modal.classList.remove('modal-show');
        
        // Ждем, пока анимация закончится (0.3s из CSS), и только потом скрываем
        setTimeout(() => {
            modal.style.display = "none";
        }, 300); // 300мс = 0.3 секунды
    }

    closeBtn.onclick = closeModal;

    // Закрытие при клике на серый фон вокруг контента
    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
});
</script>

-->
