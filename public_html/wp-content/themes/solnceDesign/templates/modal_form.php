<div id="myModal" class="modal-backdrop">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Оставьте свою заявку</h2>
        <?php echo do_shortcode('[contact-form-7 id="692e323" title="for_all"]');// Вставка формы Contact Form 7 в шаблон ?>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", startModal);

    function startModal() {
        console.log('startModal подключен');
        const modal = document.getElementById('myModal');
        const btns = document.querySelectorAll('.openModalBtn');
        const closeBtn = document.querySelector('#myModal .close-btn');

        if (!btns.length || !modal) return;

        btns.forEach(item => {
            item.onclick = function () {
                const form = document.querySelector('.wpcf7 form');
                if (form) {
                    form.querySelector('[name="acf_title"]').value = item.dataset.title || '';
                    form.querySelector('[name="acf_image"]').value = item.dataset.img || '';
                    form.querySelector('[name="acf_link"]').value = item.dataset.link || '';
                }

                modal.style.display = "flex";
                setTimeout(() => {
                    modal.classList.add('modal-show');
                }, 50);
            };
        });

        function closeModal() {
            modal.classList.remove('modal-show');
            setTimeout(() => {
                modal.style.display = "none";
            }, 300);
        }

        if (closeBtn) closeBtn.onclick = closeModal;

        window.onclick = function (event) {
            if (event.target === modal) closeModal();
        };

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('modal-show')) {
                closeModal();
            }
        });
    }

</script>