<?php get_header(); ?>

<main id="main">

    <h1>arhive</h1>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <main class="archive-main">
                    <?php if (have_posts()): ?>

                        <?php while (have_posts()):the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('archive-item'); ?>>
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="post-thumbnail">
                                        <h3>

                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        </h3>
                                    </div>
                                <?php endif; ?>

                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <div class="entry-meta">
                                    <span class="date"><?php the_time('F j, Y'); ?></span>
                                    <span class="author"><?php the_author(); ?></span>
                                </div>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                            </article>
                        <?php endwhile; ?>

                        <?php the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '&laquo;',
                            'next_text' => '&raquo;',
                        )); ?>

                    <?php else: ?>
                        <p><?php _e('No posts found.', 'solncedesign'); ?></p>
                    <?php endif; ?>
                </main>
            </div>

            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>