<?php get_header();?>

<main class="content-inner">
    <div class="container side-wrap">
        <section class="col-lg-8 col-md-12 content-center">
            <div class="blog-section">
                <h3 class="article-primehead cite-black">Gallery - <?php the_title(); ?></h3>
                <section class="blogs-inner">
                    <?php if (have_posts()) :
                        while (have_posts()) {
                            the_post(); ?>
                            <section class="blog-post">
                                <div class="data-posted">
                                    <p class="text-datetime row center-xs middle-xs"><?php echo get_the_time('j'); ?>
                                        <span><?php echo get_the_time('F'); ?></span></p>
                                </div>
                                <h4 class="article-head"><?php the_title(); ?></h4>
                                <div class="meta-inn row">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="text-desc desc-content"><?php the_content(); ?></div>
                            </section>
                        <?php };
                    else :
                        echo '<p class="text-center text-desc">Empty</p>';
                    endif; ?>
                </section>
            </div>
        </section>
        <?php get_template_part("sidebar"); ?>
    </div>
</main>

<?php get_footer(); ?>
