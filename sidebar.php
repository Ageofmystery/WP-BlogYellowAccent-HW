<aside class="col-lg-4 col-md-12 prime-bar">
    <?php if (is_page('contact')) { ?>
        <div class="block-our-contacts">
            <h3 class="article-primehead">Name</h3>
            <div class="our-info-contact">
                <address class="our-phone row middle-xs"><span class="glyphicon glyphicon-phone-alt"></span><a
                        href="tel:+<?php echo get_theme_mod('contacts_number_set'); ?>"><?php echo get_theme_mod('contacts_number_set'); ?></a></address>
                <p class="text-desc">Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan
                    ipsum velit. </p>
                <address class="our-mail row middle-xs"><span class="glyphicon glyphicon-envelope"></span><a
                        href="mailto:<?php echo get_theme_mod('contacts_email_set'); ?>"><?php echo get_theme_mod('contacts_email_set'); ?></a></address>
            </div>
        </div>
    <?php } else { ?>
        <?php dynamic_sidebar('subscribe'); ?>
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
                    'style' => 'list',
                    'title_li' => '',
                    'show_count' => 1,
                    'taxonomy' => 'category',
                );
                wp_list_categories($args); ?>
            </ul>
        </div>
        <div class="ban-x text-center">
            <a href="<?php echo get_theme_mod('banner_link_set'); ?>">
                <img src="<?php echo get_theme_mod('banner_image_set'); ?>" width="300" height="250" alt="simpleban">
            </a>
        </div>
    <?php } ?>
</aside>