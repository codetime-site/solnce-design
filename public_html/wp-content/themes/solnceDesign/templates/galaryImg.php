<style>
    .gallery-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .gallery-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 25px;
    }

    .gallery-btn {
        background: #eee;
        border: none;
        padding: 10px 22px;
        cursor: pointer;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .gallery-btn:hover {
        transform: translateY(-2px);
    }

    .gallery-btn.active {
        background: #0073aa;
        color: #fff;
    }

    .gallery-container {
        position: relative;
    }

    .gallery-grid {
        display: none;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 15px;
    }

    .gallery-grid.active {
        display: grid;
        animation: fadeIn 0.3s ease;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.25s ease;
    }

    .gallery-item img:hover {
        transform: scale(1.03);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.98);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>


<div class="gallery-wrapper">
    <div class="gallery-buttons">
        <button class="gallery-btn active" data-gallery="a">Галерея A</button>
        <button class="gallery-btn" data-gallery="b">Галерея B</button>
        <button class="gallery-btn" data-gallery="c">Галерея C</button>
    </div>

    <div class="gallery-container">
        <div class="gallery-grid gallery-a active">
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
        </div>

        <div class="gallery-grid gallery-b">
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
        </div>

        <div class="gallery-grid gallery-c">
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
            <div class="gallery-item"><img
                    src="https://img.freepik.com/free-photo/image-icon-front-side-white-background_187299-40166.jpg?t=st=1759712028~exp=1759715628~hmac=4124b5a5222ecff06fcbef3dbe565d5cf86fcef22414eb5343566acc11763803&w=1060"
                    alt=""></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.gallery-btn');
        const galleries = document.querySelectorAll('.gallery-grid');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.dataset.gallery;

                // Меняем активную кнопку
                buttons.forEach(b => b.classList.toggle('active', b === btn));

                // Показываем только нужную галерею
                galleries.forEach(g => {
                    if (g.classList.contains('gallery-' + target)) {
                        g.classList.add('active');
                    } else {
                        g.classList.remove('active');
                    }
                });
            });
        });
    });
</script>
<div class="block_padding_40"></div>
