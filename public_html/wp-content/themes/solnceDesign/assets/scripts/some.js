document.addEventListener("DOMContentLoaded", () => {
    adjustMainPadding();
    startSplide();
    startMaps();
    mobileMenu();
    refreshPortfolio()
});


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