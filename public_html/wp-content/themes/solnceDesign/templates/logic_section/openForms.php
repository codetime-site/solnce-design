<!-- Modal for service form -->
<div id="service-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; padding: 30px; border-radius: 15px; max-width: 500px; width: 90%;">
        <h3 style="margin-bottom: 20px; color: #333;">Оставить заявку</h3>
        <form method="post">
            <div style="margin-bottom:15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Имя:</label>
                <input type="text" name="service-name" placeholder="Ваше имя" required style="width:100%; padding:12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
            </div>
            <div style="margin-bottom:15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Телефон:</label>
                <input type="tel" name="service-phone" placeholder="Ваш телефон" required style="width:100%; padding:12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
            </div>
            <div style="margin-bottom:20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Город:</label>
                <input type="text" name="service-city" placeholder="Ваш город" required style="width:100%; padding:12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
            </div>
            <button type="submit" style="padding:12px 25px; background: linear-gradient(135deg, #667eea, #764ba2); color:white; border:none; border-radius: 25px; font-size: 16px; cursor: pointer;">Отправить</button>
            <button type="button" id="close-modal" style="padding:12px 25px; background: #f8f9fa; color: #333; border: 1px solid #ddd; border-radius: 25px; font-size: 16px; cursor: pointer; margin-left: 10px;">Отмена</button>
        </form>
    </div>
</div>
