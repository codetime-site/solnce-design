<?php get_header(); ?>
<main id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <header class="page-header">
                    <h1 class="page-title">
                        <?php printf(esc_html__('Tag: %s', 'solnceDesign'), single_tag_title('', false)); ?>
                    </h1>
                    <?php
                    $tag_description = tag_description();
                    if (!empty($tag_description)):
                        printf('<div class="archive-description">%s</div>', $tag_description);
                    endif;
                    ?>
                </header>

                <?php if (have_posts()): ?>
                    <div class="posts-grid">
                        <?php while (have_posts()):
                            the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="post-content">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="entry-meta">
                                        <span class="posted-on"><?php echo get_the_date(); ?></span>
                                    </div>
                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php the_posts_pagination(array(
                        'prev_text' => '&larr;',
                        'next_text' => '&rarr;',
                        'mid_size' => 2
                    )); ?>

                <?php else: ?>
                    <p><?php esc_html_e('No posts found for this tag.', 'solnceDesign'); ?></p>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

</main>
<?php get_footer(); ?>