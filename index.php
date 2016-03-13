<?php get_header();?>

<main class="content-inner">
    <div class="container">
        <section class="col-lg-8 col-md-12 content-center">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $queryPost = new WP_Query(array('post_type' => 'carousel', 'order' => 'ASC', 'posts_per_page' => 6,));
                    if ($queryPost->have_posts()) {
                        while ($queryPost->have_posts()) :
                            $queryPost->the_post(); ?>
                            <li data-target="#carousel-example-generic" data-slide-to="<?php foreach (get_post_custom_values('indicator-list') as $key => $value) { echo $value - 1; } ?>">
                                <span class="num-ind"><?php foreach (get_post_custom_values('indicator-list') as $key => $value) { echo $value; } ?></span>
                            </li>
                        <?php endwhile;
                        wp_reset_postdata();
                    } else {
                        echo '<p class="text-center text-desc">Empty</p>';
                    }; ?>
                </ol>
                <div class="carousel-inner">
                    <?php $queryPost = new WP_Query(array('post_type' => 'carousel', 'posts_per_page' => 6,));
                    if ($queryPost->have_posts()) {
                        while ($queryPost->have_posts()) :
                            $queryPost->the_post(); ?>
                            <div class="item">
                                <figure>
                                    <?php the_post_thumbnail('carousel-thumb'); ?>
                                    <svg width="693" height="63" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="-1" y="-1" width="695" height="65" class="canvas_background" fill="none"/>
                                        <path
                                            d="m1,60l0,4l692,0l0,-4l-636,0c9.241203,-11.989899 17.679901,-24.645901 26.4244,-37c4.936798,-6.974701 11.496803,-13.99594 14.5756,-22c-20.278,9.03783 -39.638199,30.1101 -57,44c-5.695599,4.556599 -12.0987,11.707298 -19,14.2616c-6.0377,2.2346 -14.62282,0.7384 -21,0.7384z"
                                            fill="#ffd501" class="svg-bg"/>
                                    </svg>
                                </figure>
                                <article class="cite-inner">
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_content(); ?>
                                </article>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    } else {
                        echo '<p class="text-center text-desc">Empty</p>';
                    }; ?>
                </div>
            </div>
            <div class="blog-section">
                <h3 class="article-primehead cite-black">Latest Blog Post</h3>
                <section class="blogs-inner">
                    <?php if (have_posts()) :
                        while (have_posts()) {
                            the_post(); ?>
                            <section class="blog-post">
                                <div class="data-posted">
                                    <p class="text-datetime row center-xs middle-xs"><?php echo get_the_time('j'); ?><span><?php echo get_the_time('F'); ?></span></p>
                                </div>
                                <h4 class="article-head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="meta-inn row">
                                    <div>
                                        <p><span class="glyphicon glyphicon-comment"></span><?php comments_number('no comments', '<strong>1</strong> comment', '<strong>%</strong> comments'); ?></p>
                                    </div>
                                    <div>
                                        <p><span class="glyphicon glyphicon-folder-open"></span><strong><?php the_category(', '); ?></strong></p>
                                    </div>
                                </div>
                                <div class="text-desc desc-content"><?php the_content(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-yellow text-uppercase">Continue Reading <span
                                        class="fa fa-chevron-right"></span></a>
                            </section>
                        <?php };
                    else :
                        echo '<p class="text-center text-desc">Empty</p>';
                    endif; ?>
                </section>
            </div>
            <?php $args = array(
                'end_size'     => 5,
                'prev_next'    => False,
            );
            the_posts_pagination($args); ?>
        </section>
        <aside class="col-lg-4 col-md-12 prime-bar">
            <div class="block-subscribe">
                <h3 class="article-primehead">Sign Up for Newsletter</h3>
                <form action="#" class="form-search">
                    <label class="text-desc"><input type="email" placeholder="Name"></label>
                    <label class="text-desc"><input type="email" placeholder="Email"></label>
                    <a href="#" class="btn btn-yellow text-uppercase">Subscribe <span class="fa fa-chevron-right"></span></a>
                </form>
            </div>
            <div class="block-most-popular">
                <h3 class="article-primehead cite-black">Most Popular</h3>
                <ul class="list-popular">
                    <?php echo most_commented_posts(6); ?>
                </ul>
            </div>
            <div class="block-categories">
                <h3 class="article-primehead">Categories</h3>
                <ul class="list-categories">
                    <li><a class="text-desc" href="#">Category Name <span class="num-cat">(23)</span></a></li>
                    <li><a class="text-desc" href="#">Category Name <span class="num-cat">(23)</span></a></li>
                    <li><a class="text-desc" href="#">Category Name <span class="num-cat">(23)</span></a></li>
                    <li><a class="text-desc" href="#">Category Name <span class="num-cat">(23)</span></a></li>
                    <li><a class="text-desc" href="#">Category Name <span class="num-cat">(23)</span></a></li>
                </ul>
            </div>
            <div class="ban-x text-center">
                <img src="#" width="300" height="250" alt="simpleban">
            </div>
        </aside>
    </div>
</main>

<?php get_footer(); ?>
