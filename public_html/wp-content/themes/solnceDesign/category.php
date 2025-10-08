<?php get_header(); ?>


<main id="main">
    <div class="container">
        <div class="header_block">
            <h2 class="title"> <?php single_cat_title(); ?></h2>
            <hr class="title__under">
        </div>

        <div class="category-container">
            <div class="category">
                <ul class="category__list">

                    <?php if (category_description()): ?>
                        <div class="category-description">
                            <?php echo category_description(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (have_posts()): ?>
                        <div class="category-list">
                            <?php while (have_posts()): the_post(); ?>
                            <?php $category_image = get_field('img', 'category_' . get_the_ID());
                                // var_dump(get_the_post(  ));
                            ?>
                                <div class="category-item">
                                    <div class="category-item-title"><?php the_title(); ?>:id= <?php the_ID();?></div>
                                    <div class="category-item-excerpt"><?php the_excerpt(); ?></div>
                                    <a class="category-item-link" href="<?php the_permalink(); ?>">Подробнее</a>
                                    <img src="<?php echo $category_image;?>" alt="">
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div style="margin-top:32px;text-align:center;">
                            <?php the_posts_pagination([
                                'mid_size' => 2,
                                'prev_text' => '←',
                                'next_text' => '→',
                            ]); ?>
                        </div>
                    <?php else: ?>
                        <p style="text-align:center;">В этой категории пока нет записей.</p>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>



<style>
    ul.category__list {
        display: flex;
        flex-wrap: wrap;
        /* background: red; */
        gap: 15px;
        justify-content: center;
        color: black;

    }

    .category-item-title a {
        font-size: 1.5rem;
        font-weight: 600;
        color: black;
        text-decoration: none;
    }

    .category-item-image {
        width: 100px;
        height: 100px;
        /* height: auto; */
        border-radius: 50%;
        overflow: hidden;
        border: 2px #c77022 solid;

    }

    .category-item-image img {
        object-fit: cover;
        /* max-width: 100%; */
        width: 100%;
        height: 100%;
    }

    .category-item {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        border-radius: 15px;
        border: 2px red solid;
        padding: 15px;

        max-width: 300px;
        min-width: 220px;

    }
</style>