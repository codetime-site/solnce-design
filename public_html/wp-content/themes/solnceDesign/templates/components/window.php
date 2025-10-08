<div class="win">
    <div class="win__img">
        <a href="" class="win__link">Связаться с нами</a>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero_img.jpg " alt="">
    </div>
    <div class="win__text grid_block">
        <div class="win__text_up">
           <i class="fontello-medal-1 icon_type1"></i> <h3>Освещение</h3>
        </div>
        <p> Подбираем и устанавливаем светильники, треки, люстры и декоративную подсветку — от базового
            освещения до дизайнерских решений. Эффективный свет — залог уюта и акцентов в интерьере.</p>
        <!-- <div class="win_btm"><button class="btn_win">Связаться с нами</button></div> -->
    </div>
</div>

<script>
    
document.querySelectorAll(".win").forEach(function(item) {
    const link = item.querySelector(".win__link"); // Находим .win__link внутри текущего .win__img
    item.addEventListener("mouseover", function() {
        if (link) {
            link.style.display = "block"; // Показываем ссылку
        }
    });
    item.addEventListener("mouseout", function() {
        if (link) {
            link.style.display = "none"; // Скрываем ссылку
        }
    });
});
</script>