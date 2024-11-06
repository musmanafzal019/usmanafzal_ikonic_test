<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
    <div class="container sect-4">
        <div class="row justify-content-center">
            <?php
            while ( have_posts() ) {
                the_post();
                $post_title = get_the_title();
                $post_id = get_the_ID();
                $feature_image = get_the_post_thumbnail_url();
                $post_permalink = get_permalink();
                $post_excerpt = get_blog_content('200', $post_id);
                $term_obj_list = get_the_terms( $post_id, 'category' );
                $terms_string = join(' | ', wp_list_pluck($term_obj_list, 'name'));
                ?>
                <div class="col-md-8">
                    <div class="card card-blog">
                        <?php if (!empty($feature_image)){ ?>
                            <div class="card-img">
                                <a href="<?php echo $post_permalink; ?>"><img src="<?php echo $feature_image; ?>" alt="" class="img-fluid"></a>
                            </div>
                        <?php } else{ ?>
                            <div class="card-img">
                                <a href="<?php echo $post_permalink; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/post-1.jpg" alt="" class="img-fluid"></a>
                            </div>
                        <?php } ?>
                        <div class="card-body">
                            <?php
                            if (!empty($terms_string)){
                                ?>
                                <div class="card-category-box">
                                    <div class="card-category">
                                        <h6 class="category"><?php echo $terms_string; ?></h6>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <h3 class="card-title"><a href="<?php echo $post_permalink; ?>"><?php echo $post_title; ?></a></h3>
                            <?php if (!empty($post_excerpt)){ ?>
                                <p class="card-description"><?php echo $post_excerpt; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
<?php
get_footer();
