<?php
/*
Template Name: Конструктор Балкона
*/
get_header();
?>
<main id="main">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        #container {
            display: flex;
            flex: 1;
        }
        #left-panel {
            width: 250px;
            background: #f8f9fa;
            border-right: 1px solid #ccc;
            padding: 20px;
            overflow-y: auto;
        }
        #main-area {
            flex: 1;
            position: relative;
            background: #e9ecef;
            overflow: hidden;
        }
        #balcony-view {
            position: relative;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }
        .layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 1;
            transition: opacity 0.5s;
        }
        #glazing-layer {
            top: 0;
            left: 0;
        }
        #parapet-layer {
            bottom: 0;
            left: 0;
            height: 20%;
        }
        #insulation-layer {
            top: 0;
            left: 0;
        }
        #lighting-layer {
            top: 0;
            left: 0;
        }
        #walls-layer {
            top: 0;
            left: 0;
        }
        #floor-layer {
            bottom: 0;
            left: 0;
            height: 10%;
        }
        #cabinet-layer {
            bottom: 10%;
            right: 10%;
            width: 30%;
            height: 40%;
        }
        #right-panel {
            width: 250px;
            background: #f8f9fa;
            border-left: 1px solid #ccc;
            padding: 20px;
            overflow-y: auto;
        }
        .category {
            margin-bottom: 20px;
        }
        .category h4 {
            margin: 0 0 10px 0;
        }
        .options {
            display: flex;
            flex-wrap: wrap;
        }
        .option {
            width: 60px;
            height: 60px;
            margin: 5px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s;
            background-size: cover;
            background-position: center;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            text-align: center;
        }
        .option:hover, .option.active {
            border-color: #007bff;
        }
        .reset-btn, .save-btn {
            margin-top: 20px;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        @media (max-width: 768px) {
            #container {
                flex-direction: column;
            }
            #left-panel, #right-panel {
                width: 100%;
                height: auto;
            }
        }
    </style>
    <div id="container">
        <div id="left-panel">
            <div class="category" id="glazing">
                <h4>Вид остекления</h4>
                <div class="options">
                    <div class="option" data-value="warm">Теплое</div>
                    <div class="option" data-value="cold">Холодное</div>
                </div>
            </div>
            <div class="category" id="parapet">
                <h4>Обшивка парапета</h4>
                <div class="options">
                    <div class="option" data-value="siding">Сайдинг</div>
                    <div class="option" data-value="profile">Профлист</div>
                    <div class="option" data-value="none">Убрать</div>
                </div>
            </div>
            <div class="category" id="insulation">
                <h4>Утепление</h4>
                <div class="options">
                    <div class="option" data-value="standard">Стандарт</div>
                    <div class="option" data-value="none">Убрать</div>
                </div>
            </div>
            <div class="category" id="lighting">
                <h4>Освещение</h4>
                <div class="options">
                    <div class="option" data-value="ceiling">Потолок</div>
                    <div class="option" data-value="wall">Стена</div>
                    <div class="option" data-value="none">Убрать</div>
                </div>
            </div>
        </div>
        <div id="main-area">
            <div id="balcony-view">
                <img class="layer" id="base" src="<?php echo get_template_directory_uri(); ?>/images/base_balcony.png" alt="Базовый балкон">
                <img class="layer" id="glazing-layer" src="" alt="Остекление" style="display: none;">
                <img class="layer" id="parapet-layer" src="" alt="Парапет" style="display: none;">
                <img class="layer" id="insulation-layer" src="" alt="Утепление" style="display: none;">
                <img class="layer" id="lighting-layer" src="" alt="Освещение" style="display: none;">
                <img class="layer" id="walls-layer" src="" alt="Стены" style="display: none;">
                <img class="layer" id="floor-layer" src="" alt="Пол" style="display: none;">
                <img class="layer" id="cabinet-layer" src="" alt="Шкаф" style="display: none;">
            </div>
        </div>
        <div id="right-panel">
            <div class="category" id="walls">
                <h4>Отделка стен</h4>
                <div class="options">
                    <div class="option" data-value="pvc">ПВХ панели</div>
                    <div class="option" data-value="lining">Вагонка</div>
                    <div class="option" data-value="gypsum">Гипсокартон</div>
                    <div class="option" data-value="pvc-lining">ПВХ вагонка</div>
                </div>
            </div>
            <div class="category" id="floor">
                <h4>Отделка пола</h4>
                <div class="options">
                    <div class="option" data-value="laminate">Ламинат</div>
                    <div class="option" data-value="linoleum">Линолеум</div>
                    <div class="option" data-value="carpet">Ковролин</div>
                    <div class="option" data-value="tile">Плитка</div>
                </div>
            </div>
            <div class="category" id="cabinet">
                <h4>Шкаф</h4>
                <div class="options">
                    <div class="option" data-value="wardrobe">Шкаф</div>
                    <div class="option" data-value="coupe">Купе</div>
                    <div class="option" data-value="stand">Тумба</div>
                    <div class="option" data-value="none">Убрать</div>
                </div>
            </div>
            <button class="reset-btn" onclick="resetDesign()">Сбросить всё</button>
            <button class="save-btn" onclick="saveDesign()">Сохранить дизайн</button>
        </div>
    </div>

    <script>
        const themeUri = "<?php echo get_template_directory_uri(); ?>";
        const categories = {
            glazing: {
                title: "Вид остекления",
                options: {
                    warm: { img: themeUri + "/images/glazing_warm.png", mini: themeUri + "/images/glazing_warm.png" },
                    cold: { img: themeUri + "/images/glazing_cold.png", mini: themeUri + "/images/glazing_cold.png" }
                }
            },
            parapet: {
                title: "Обшивка парапета",
                options: {
                    siding: { img: themeUri + "/images/parapet_siding.png", mini: themeUri + "/images/parapet_siding.png" },
                    profile: { img: themeUri + "/images/parapet_profile.png", mini: themeUri + "/images/parapet_profile.png" },
                    none: { img: "", mini: "" }
                }
            },
            insulation: {
                title: "Утепление",
                options: {
                    standard: { img: themeUri + "/images/insulation_standard.png", mini: themeUri + "/images/insulation_standard.png" },
                    none: { img: "", mini: "" }
                }
            },
            lighting: {
                title: "Освещение",
                options: {
                    ceiling: { img: themeUri + "/images/lighting_ceiling.png", mini: themeUri + "/images/lighting_ceiling.png" },
                    wall: { img: themeUri + "/images/lighting_wall.png", mini: themeUri + "/images/lighting_wall.png" },
                    none: { img: "", mini: "" }
                }
            },
            walls: {
                title: "Отделка стен",
                options: {
                    pvc: { img: themeUri + "/images/walls_pvc.png", mini: themeUri + "/images/walls_pvc.png" },
                    lining: { img: themeUri + "/images/walls_lining.png", mini: themeUri + "/images/walls_lining.png" },
                    gypsum: { img: themeUri + "/images/walls_gypsum.png", mini: themeUri + "/images/walls_gypsum.png" },
                    "pvc-lining": { img: themeUri + "/images/walls_pvc_lining.png", mini: themeUri + "/images/walls_pvc_lining.png" }
                }
            },
            floor: {
                title: "Отделка пола",
                options: {
                    laminate: { img: themeUri + "/images/floor_laminate.png", mini: themeUri + "/images/floor_laminate.png" },
                    linoleum: { img: themeUri + "/images/floor_linolium.png", mini: themeUri + "/images/floor_linolium.png" },
                    carpet: { img: themeUri + "/images/floor_carpet.png", mini: themeUri + "/images/floor_carpet.png" },
                    tile: { img: themeUri + "/images/floor_tile.png", mini: themeUri + "/images/floor_tile.png" }
                }
            },
            cabinet: {
                title: "Шкаф",
                options: {
                    wardrobe: { img: themeUri + "/images/cabinet_wardrobe.png", mini: themeUri + "/images/cabinet_wardrobe.png" },
                    coupe: { img: themeUri + "/images/cabinet_coupe.png", mini: themeUri + "/images/cabinet_coupe.png" },
                    stand: { img: themeUri + "/images/cabinet_stand.png", mini: themeUri + "/images/cabinet_stand.png" },
                    none: { img: "", mini: "" }
                }
            }
        };

        let selections = JSON.parse(localStorage.getItem('balconySelections')) || {};

        function updateLayer(category, value) {
            const layerId = category + '-layer';
            const layer = document.getElementById(layerId);
            const src = categories[category].options[value].img;
            if (src) {
                layer.src = src;
                layer.style.display = 'block';
            } else {
                layer.style.display = 'none';
            }
            selections[category] = value;
            localStorage.setItem('balconySelections', JSON.stringify(selections));
        }

        function loadSelections() {
            for (const [cat, val] of Object.entries(selections)) {
                updateLayer(cat, val);
                // Set active class
                const options = document.querySelectorAll(`#${cat} .option`);
                options.forEach(opt => {
                    if (opt.dataset.value === val) {
                        opt.classList.add('active');
                    }
                });
            }
            // Set mini images
            Object.keys(categories).forEach(cat => {
                const opts = categories[cat].options;
                Object.keys(opts).forEach(val => {
                    const opt = opts[val];
                    const optionEl = document.querySelector(`#${cat} .option[data-value="${val}"]`);
                    if (optionEl && opt.mini) {
                        optionEl.style.backgroundImage = `url(${opt.mini})`;
                        optionEl.textContent = ''; // Remove text if image
                    }
                });
            });
        }

        function resetDesign() {
            selections = {};
            localStorage.removeItem('balconySelections');
            document.querySelectorAll('.layer').forEach(layer => {
                if (layer.id !== 'base') {
                    layer.style.display = 'none';
                }
            });
            document.querySelectorAll('.option.active').forEach(opt => opt.classList.remove('active'));
        }

        function saveDesign() {
            // Placeholder for save functionality, e.g., send to server or export
            alert('Дизайн сохранен: ' + JSON.stringify(selections));
        }

        // Event listeners
        document.querySelectorAll('.option').forEach(option => {
            option.addEventListener('click', () => {
                const category = option.closest('.category').id;
                const value = option.dataset.value;
                // Remove active from siblings
                option.parentElement.querySelectorAll('.option').forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                updateLayer(category, value);
            });
        });

        // Load initial selections
        loadSelections();
    </script>
</main>
<?php get_footer(); ?>