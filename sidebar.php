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
            <?php $args = array(
                'style'              => 'list',
                'title_li'           => '',
                'show_count'         => 1,
                'taxonomy'           => 'category',
            );
            wp_list_categories( $args ); ?>
        </ul>
    </div>
    <div class="ban-x text-center">
        <img src="#" width="300" height="250" alt="simpleban">
    </div>
</aside>