<?php
/*
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
        #room-selector {
            display: flex;
            justify-content: center;
            padding: 10px;
            background: #f0f0f0;
        }
        #room-selector button {
            margin: 0 10px;
            padding: 10px 20px;
            cursor: pointer;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #room-selector button.active {
            background: #007bff;
            color: white;
        }
        #container {
            display: flex;
            flex: 1;
        }
        #main-area {
            flex: 1;
            position: relative;
            background: #e9ecef;
            overflow: hidden;
        }
        #room-layout {
            position: relative;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }
        .hotspot {
            position: absolute;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s;
        }
        .hotspot:hover {
            border-color: #007bff;
        }
        .element {
            position: absolute;
            pointer-events: none;
        }
        .element img {
            max-width: 100%;
            height: auto;
        }
        #right-panel {
            width: 300px;
            background: #f8f9fa;
            border-left: 1px solid #ccc;
            padding: 20px;
            overflow-y: auto;
        }
        #variants {
            display: flex;
            flex-wrap: wrap;
        }
        .variant {
            width: 80px;
            height: 80px;
            margin: 10px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s;
            background-size: cover;
            background-position: center;
            background-color: #ddd;
        }
        .variant:hover, .variant.active {
            border-color: #007bff;
        }
        @media (max-width: 768px) {
            #container {
                flex-direction: column;
            }
            #right-panel {
                width: 100%;
                height: 200px;
            }
        }
    </style>
    <div id="room-selector">
        <button data-room="bedroom">Спальня</button>
        <button data-room="livingroom">Гостиная</button>
        <button data-room="kitchen">Кухня</button>
    </div>
    <div id="container">
        <div id="main-area">
            <div id="room-layout"></div>
        </div>
        <div id="right-panel">
            <h3>Выберите вариант</h3>
            <div id="variants"></div>
        </div>
    </div>

    <script>
        const data = {
            bedroom: {
                background: 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                elements: {
                    bed: {
                        name: 'Кровать',
                        hotspot: { x: 200, y: 250, w: 300, h: 150 },
                        position: { x: 200, y: 250 },
                        variants: [
                            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80',
                            'https://images.unsplash.com/photo-1540574163026-643ea20ade25?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80',
                            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80'
                        ]
                    },
                    wall: {
                        name: 'Картина',
                        hotspot: { x: 50, y: 50, w: 100, h: 200 },
                        position: { x: 50, y: 50 },
                        variants: [
                            'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80',
                            'https://images.unsplash.com/photo-1541961017774-22349e4a1262?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80'
                        ]
                    },
                    armchair: {
                        name: 'Кресло',
                        hotspot: { x: 600, y: 300, w: 100, h: 100 },
                        position: { x: 600, y: 300 },
                        variants: [
                            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80',
                            'https://images.unsplash.com/photo-1549497538-303791108f95?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80'
                        ]
                    }
                }
            },
            livingroom: {
                background: 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                elements: {
                    sofa: {
                        name: 'Диван',
                        hotspot: { x: 150, y: 200, w: 400, h: 150 },
                        position: { x: 150, y: 200 },
                        variants: [
                            'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80',
                            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80'
                        ]
                    },
                    table: {
                        name: 'Стол',
                        hotspot: { x: 300, y: 400, w: 150, h: 100 },
                        position: { x: 300, y: 400 },
                        variants: [
                            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&q=80'
                        ]
                    }
                }
            },
            kitchen: {
                background: 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                elements: {
                    fridge: {
                        name: 'Холодильник',
                        hotspot: { x: 50, y: 100, w: 100, h: 200 },
                        position: { x: 50, y: 100 },
                        variants: [
                            'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80'
                        ]
                    }
                }
            }
        };

        let currentRoom = null;
        let currentElement = null;
        let selections = JSON.parse(localStorage.getItem('constructorSelections')) || {};

        function loadRoom(roomKey) {
            currentRoom = roomKey;
            const room = data[roomKey];
            const layout = document.getElementById('room-layout');
            layout.style.backgroundImage = `url(${room.background})`;
            layout.innerHTML = '';

            // Create hotspots and elements
            for (const [key, el] of Object.entries(room.elements)) {
                // Hotspot
                const hotspot = document.createElement('div');
                hotspot.className = 'hotspot';
                hotspot.style.left = el.hotspot.x + 'px';
                hotspot.style.top = el.hotspot.y + 'px';
                hotspot.style.width = el.hotspot.w + 'px';
                hotspot.style.height = el.hotspot.h + 'px';
                hotspot.dataset.element = key;
                hotspot.addEventListener('click', () => selectElement(key));
                layout.appendChild(hotspot);

                // Element image
                const elementDiv = document.createElement('div');
                elementDiv.className = 'element';
                elementDiv.id = `element-${key}`;
                elementDiv.style.left = el.position.x + 'px';
                elementDiv.style.top = el.position.y + 'px';
                elementDiv.style.width = el.hotspot.w + 'px';
                elementDiv.style.height = el.hotspot.h + 'px';
                const selectedVariant = selections[roomKey] && selections[roomKey][key] || 0;
                const img = document.createElement('img');
                img.src = el.variants[selectedVariant];
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'contain';
                elementDiv.appendChild(img);
                layout.appendChild(elementDiv);
            }
        }

        function selectElement(elementKey) {
            currentElement = elementKey;
            const rightPanel = document.getElementById('right-panel');
            const h3 = rightPanel.querySelector('h3');
            const variantsDiv = document.getElementById('variants');
            variantsDiv.innerHTML = '';
            const el = data[currentRoom].elements[elementKey];
            h3.innerHTML = `Выберите вариант для ${el.name}`;
            el.variants.forEach((variant, index) => {
                const variantDiv = document.createElement('div');
                variantDiv.className = 'variant';
                variantDiv.style.backgroundImage = `url(${variant})`;
                variantDiv.dataset.index = index;
                if (selections[currentRoom] && selections[currentRoom][elementKey] == index) {
                    variantDiv.classList.add('active');
                }
                variantDiv.addEventListener('click', () => selectVariant(index));
                variantsDiv.appendChild(variantDiv);
            });
        }

        function selectVariant(index) {
            if (!currentElement) return;
            const el = data[currentRoom].elements[currentElement];
            const img = document.querySelector(`#element-${currentElement} img`);
            img.style.opacity = 0;
            setTimeout(() => {
                img.src = el.variants[index];
                img.style.opacity = 1;
            }, 300);
            if (!selections[currentRoom]) selections[currentRoom] = {};
            selections[currentRoom][currentElement] = index;
            localStorage.setItem('constructorSelections', JSON.stringify(selections));
            // Update active class
            document.querySelectorAll('.variant').forEach(v => v.classList.remove('active'));
            document.querySelector(`.variant[data-index="${index}"]`).classList.add('active');
        }

        // Room selector
        document.querySelectorAll('#room-selector button').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('#room-selector button').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                loadRoom(btn.dataset.room);
            });
        });

        // Load default room
        loadRoom('bedroom');
        document.querySelector('button[data-room="bedroom"]').classList.add('active');
    </script>
</main>
<?php get_footer(); ?>