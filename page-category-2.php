<?php get_header();?>

<main class="content-inner">
    <div class="container">
        <section class="col-lg-8 col-md-12 content-center">
            <div class="blog-section">
                <h3 class="article-primehead cite-black"><?php the_title(); ?> - Gallery</h3>
                <section class="blogs-inner row between-lg around-sm center-xs">
                    <?php $queryPost = new WP_Query(array('post_type' => 'gallery', 'posts_per_page' => 12,));
                    if ($queryPost->have_posts()) {
                        while ($queryPost->have_posts()) :
                            $queryPost->the_post(); ?>
                            <section class="blog-gallery-post">
                                <h4 class="article-primehead"><?php the_title(); ?></h4>
                                <figure>
                                    <?php the_post_thumbnail(); ?>
                                    <figcaption class="article-primehead"><a href="<?php the_permalink(); ?>"><?php the_content(); ?></a></figcaption>
                                </figure>
                            </section>
                        <?php endwhile;
                        wp_reset_postdata();
                    } else {
                        echo '<p class="text-center text-desc">Empty</p>';
                    }; ?>
                </section>
            </div>
            <?php $args = array(
                'end_size'     => 5,
                'prev_next'    => False,
            );
            the_posts_pagination($args); ?>
        </section>
        <?php get_template_part("sidebar"); ?>
    </div>
</main>

<?php get_footer(); ?>
