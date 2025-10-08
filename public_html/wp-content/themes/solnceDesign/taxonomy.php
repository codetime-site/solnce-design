<?php get_header(); ?>

<div class="container taxonomy-container">
    <div class="row">
        <div class="col-md-8">
            <div class="taxonomy-header">
                <h1 class="taxonomy-title">
                    <?php single_term_title(); ?>
                </h1>
                <?php if (term_description()) : ?>
                    <div class="taxonomy-description">
                        <?php echo term_description(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (have_posts()) : ?>
                <div class="taxonomy-posts">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('taxonomy-post'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="post-meta">
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>

                    <div class="pagination">
                        <?php echo paginate_links(); ?>
                    </div>
                </div>
            <?php else : ?>
                <p><?php _e('No posts found.', 'solncedesign'); ?></p>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>