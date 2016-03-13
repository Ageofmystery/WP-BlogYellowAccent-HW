<?php get_header();?>

<main class="content-inner">
    <div class="container">
        <section class="col-lg-8 col-md-12 content-center">
            <div class="blog-section">
                <h3 class="article-primehead cite-black">Page - <?php the_title(); ?></h3>
                <section class="blogs-inner">
                    <?php if (have_posts()) :
                        while (have_posts()) {
                            the_post(); ?>
                            <section class="blog-post">
                                <div class="data-posted">
                                    <p class="text-datetime row center-xs middle-xs"><?php echo get_the_time('j'); ?><span><?php echo get_the_time('F'); ?></span></p>
                                </div>
                                <h4 class="article-head"><?php the_title(); ?></h4>
                                <div class="meta-inn row">
                                    <div>
                                        <p><span class="glyphicon glyphicon-comment"></span><?php comments_number('no comments', '<strong>1</strong> comment', '<strong>%</strong> comments'); ?></p>
                                    </div>
                                    <div>
                                        <p><span class="glyphicon glyphicon-folder-open"></span><strong><?php the_category(', '); ?></strong></p>
                                    </div>
                                </div>
                                <div class="text-desc desc-content">
                                    <p class="text-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean a accumsan ante, sit amet scelerisque ex. Ut at ante mollis diam ultricies lacinia vel in mauris. In quis ullamcorper felis. Fusce suscipit in mauris et suscipit. Sed molestie turpis at enim varius porttitor. Integer dapibus eget nisl eget sodales. Maecenas laoreet in purus eget faucibus. Ut nulla leo, iaculis in ipsum id, fringilla feugiat justo. Proin mattis erat nec justo lobortis molestie. Aliquam quis magna ac ligula luctus placerat. Aenean ut dapibus velit. Nulla facilisi. Mauris sit amet erat dolor.</p>
                                    <p class="text-desc">Quisque consequat elit sed tortor pellentesque, eget mattis eros ornare. In ut ultrices augue, vel varius tortor. Phasellus facilisis eleifend porta. Curabitur cursus nisl ut semper condimentum. Integer commodo leo et felis commodo fringilla sed at est. Curabitur non nunc et sem pellentesque feugiat. Sed imperdiet massa quis purus commodo cursus. Sed diam urna, laoreet non imperdiet et, pellentesque posuere turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc sagittis consectetur dui, et maximus ligula mattis vitae. Vestibulum venenatis sapien sed vehicula ultrices. Maecenas ultricies quis lectus sit amet lacinia.</p>
                                    <p class="text-desc">Aenean sit amet justo vel velit laoreet malesuada a vel ante. Aliquam erat volutpat. Cras condimentum porta ante, et rutrum libero lobortis ut. In id libero tincidunt, semper erat eu, gravida velit. Curabitur ut ipsum vestibulum, hendrerit nisl ut, fringilla enim. Vestibulum nibh neque, rutrum a dui non, facilisis ultrices dolor. Curabitur ut mi at enim semper pulvinar sed a lectus. Sed in mattis tellus.</p>
                                    <p class="text-desc">Duis blandit nunc nunc, nec tempus mi pharetra eget. Proin egestas varius orci. Nunc lectus ipsum, maximus venenatis mollis id, sagittis sit amet eros. Quisque pharetra lectus vitae ultrices tempus. Quisque ac massa in dui faucibus sagittis. Quisque auctor vel lacus quis tristique. Curabitur placerat sit amet turpis id sagittis. Mauris lacinia risus vitae consectetur tempus. Etiam et dapibus arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum facilisis dictum est in pretium. Sed eleifend feugiat eros, vitae mattis nibh sollicitudin quis. Suspendisse imperdiet orci vitae metus iaculis tincidunt. Aliquam convallis ex ligula, in laoreet quam varius vitae.</p>
                                    <p class="text-desc">Nullam egestas vel mauris at condimentum. Cras metus sapien, mattis eu ante et, placerat viverra velit. Sed facilisis, augue sed hendrerit ullamcorper, elit neque viverra leo, at eleifend lectus ipsum a nunc. Nunc rutrum nibh turpis, eu consequat metus posuere sed. Nunc scelerisque vitae tellus ut fermentum. Cras varius elit quam, quis dignissim eros sollicitudin eget. Proin vulputate orci eu augue viverra accumsan. Praesent quis sapien eget enim scelerisque efficitur in quis libero. Vivamus condimentum, lacus pharetra volutpat tempus, tellus magna eleifend libero, vitae feugiat est sem nec felis. Etiam eget efficitur odio, vulputate blandit quam. Sed convallis nec nisl ut posuere. Nunc non lectus vel nisi placerat condimentum.</p>
                                    <p class="text-desc">Sed ultrices in enim sit amet posuere. Vivamus pulvinar est vitae metus elementum, in venenatis sem finibus. Sed sodales ut arcu sed euismod. Aliquam erat volutpat. Praesent fringilla nisl id velit semper, eget elementum justo malesuada. Sed porta nulla sed diam posuere, id porttitor neque finibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu pellentesque ligula. Morbi ultrices, magna eu tristique elementum, orci purus congue tortor, ut scelerisque nisi erat ut risus.</p>
                                    <p class="text-desc">Phasellus blandit semper diam, ac pellentesque urna venenatis venenatis. Mauris consequat finibus lectus non pretium. Quisque tempus facilisis semper. Praesent feugiat rutrum sapien, a convallis nisi scelerisque accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ipsum felis, tempus et sem vitae, venenatis volutpat mi. Quisque at lacus vitae elit pellentesque ultricies.</p>
                                    <p class="text-desc">Suspendisse non eros quis nisl finibus vestibulum et ac ex. Donec ex quam, condimentum ut nunc quis, consequat eleifend dui. Etiam a libero efficitur, porta turpis ac, varius nulla. Praesent faucibus, sapien sed accumsan commodo, libero lacus rhoncus est, et imperdiet risus ante eget leo. Nullam in elit consequat, ullamcorper lectus vel, dictum lorem. Etiam accumsan eros elit, non consequat dolor tempus feugiat. Curabitur et felis finibus, congue nisi sit amet, ullamcorper orci. Integer lacinia tincidunt enim at interdum. Phasellus dictum erat nec felis finibus gravida.</p>
                                </div>
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
        <?php get_template_part("sidebar"); ?>
    </div>
</main>

<?php get_footer(); ?>
