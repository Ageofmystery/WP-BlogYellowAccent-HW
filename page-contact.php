<?php get_header();?>

<main class="content-inner">
    <div class="container side-wrap">
        <section class="col-lg-8 col-md-12 content-center">
            <div class="info-contact row middle-xs">
                <figure>
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/img/phone-contact.png" width="500" height="366" alt="Homephone">
                </figure>
                <article class="prime-info">
                    <h2 class="article-primehead">Contact</h2>
                    <p class="text-desc">Morbi accumsan ipsum velit.</p>
                    <p class="text-desc">Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. </p>
                </article>
            </div>
            <div class="contact-form-section">
                <?php dynamic_sidebar('contact_form'); ?>
            </div>
        </section>
        <?php get_template_part("sidebar"); ?>
    </div>
</main>

<?php get_footer(); ?>
