<?php while (have_rows('flex_page')) : the_row(); ?>
    <?php $layout = get_row_layout(); ?>
    <?php switch ($layout) :
        case 'hero':
            get_template_part('templates/hero');
            break;

        case 'work_step':
            get_template_part('templates/work');
            break;

        case 'our_project':
            get_template_part('templates/project');
            break;

        case 'reviews':
            get_template_part('templates/reviews');
            break;

        case 'service':
            get_template_part('templates/service');
            break;

        case 'order':
            get_template_part('templates/universal');
            break;

        case 'single_galary':
            get_template_part('templates/single_galary');
            break;

        case 'connect':
            $acf_post_obj = get_sub_field('post');
            if ($acf_post_obj) {
                foreach ($acf_post_obj as $post) {
                    setup_postdata($post);
                    if (have_rows('flex_page')) {
                        get_template_part('templates/flex/flex');
                    }
                }
                wp_reset_postdata();
            }
            break;

        case 'video':
            get_template_part('templates/videos');
            break;

        case 'rec':
            get_template_part('templates/rec');
            break;

        case 'worker':
            get_template_part('templates/professionals');
            break;

        case 'maps':
            get_template_part('templates/maps');
            break;

        case 'contact':
            get_template_part('templates/contact');
            break;

        case 'form':
            get_template_part('templates/form');
            break;

        case 'galary':
            get_template_part('templates/galaryImg');
            break;

        case 'postforproduct':
            get_template_part('templates/galary');
            break;

        case 'constructor':
            get_template_part('templates/constructor');
            break;

        case 'portfolio':
            get_template_part('templates/portfolio');
            break;

        case 'single_select_materials':
            get_template_part('templates/single_select_materials');
            break;

        case 'parent_cat':
            get_template_part('templates/parent_cat');
            break;

        // case 'catalog':
        //     get_template_part('templates/delete/catalog');
        //     break;

        default:
            // Можно добавить логирование или заглушку
            // error_log("Неизвестный layout: $layout");
            break;

    endswitch; ?>

<?php endwhile; ?>