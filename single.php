<?php get_header();?>

<main class="content-inner">
    <div class="container">
        <section class="col-lg-8 col-md-12 content-center">
            <div class="blog-section">
                <h3 class="article-primehead cite-black">Post - <?php the_title(); ?></h3>
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
                                    <div>
                                        <p>
                                            <span class="glyphicon glyphicon-comment"></span><?php comments_number('no comments', '<strong>1</strong> comment', '<strong>%</strong> comments'); ?>
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            <span class="glyphicon glyphicon-folder-open"></span><strong><?php the_category(', '); ?></strong>
                                        </p>
                                    </div>
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
