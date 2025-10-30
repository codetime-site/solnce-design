jQuery(document).ready(function($){
    const parentFilter = $('#parent-category-filter');
    const subcategoryFilter = $('#subcategory-filter');
    const colorFilter = $('#color-filter');
    const styleFilter = $('#style-filter');
    const materialFilter = $('#material-filter');
    const clearFiltersBtn = $('#clear-filters');
    const productsList = $('#products-list');

    let currentPage = 1;

    function getFilterData() {
        return {
            action: 'filter_products',
            page: currentPage,
            posts_per_page: vpCatalogData.posts_per_page,
            parent: parentFilter.val(),
            subcategory: subcategoryFilter.val(),
            color: colorFilter.val(),
            style: styleFilter.val(),
            material: materialFilter.val()
        };
    }

    function loadProducts() {
        $.ajax({
            url: vpCatalogData.ajax_url,
            type: 'POST',
            data: getFilterData(),
            beforeSend: function(){
                productsList.html('<p>Загрузка...</p>');
            },
            success: function(response){
                if(response.success){
                    productsList.html(response.data.html);
                } else {
                    productsList.html('<p>Ошибка загрузки товаров</p>');
                }
            },
            error: function(){
                productsList.html('<p>Ошибка загрузки товаров</p>');
            }
        });
    }

    // обновление подкатегорий
    parentFilter.on('change', function(){
        const parentId = $(this).val();
        subcategoryFilter.empty().append('<option value="">Выберите подкатегорию</option>');
        if(parentId && typeof vpCatalogData.categories !== 'undefined'){
            const subs = vpCatalogData.categories.filter(c => c.parent == parentId);
            subs.forEach(s => subcategoryFilter.append(`<option value="${s.id}">${s.name}</option>`));
        }
        loadProducts();
    });

    // остальные фильтры
    subcategoryFilter.on('change', loadProducts);
    colorFilter.on('change', loadProducts);
    styleFilter.on('change', loadProducts);
    materialFilter.on('change', loadProducts);

    // сброс фильтров
    clearFiltersBtn.on('click', function(){
        parentFilter.val('');
        subcategoryFilter.empty().append('<option value="">Выберите подкатегорию</option>');
        colorFilter.val('');
        styleFilter.val('');
        materialFilter.val('');
        currentPage = 1;
        loadProducts();
    });

    // первичная загрузка
    loadProducts();
});
