<?php
/**
 * Template Name: Home
 */

get_header();
wp_reset_query();
$args = array(
    'post_type' => 'projects',
    'status' => 'publish',
    'posts_per_page' => 6
);

$portfolio = new WP_Query($args);
if ($portfolio->have_posts()){
    ?>
    <!-- ======= Portfolio Section ======= -->
    <section id="work" class="portfolio-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a mb-4">
                            Portfolio
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                while ($portfolio->have_posts()){
                    $portfolio->the_post();
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $feature_image = get_the_post_thumbnail_url();
                    $post_permalink = get_permalink();
                    $project_name = get_field('project_name', false, false);
                    ?>
                    <div class="col-md-4">
                        <div class="work-box">
                            <?php if (!empty($feature_image)){ ?>
                                <a href="<?php echo $post_permalink; ?>" data-gall="portfolioGallery" class="venobox">
                                    <div class="work-img">
                                        <img src="<?php echo $feature_image; ?>" alt="" class="img-fluid">
                                    </div>
                                </a>
                            <?php } ?>
                            <div class="work-content">
                                <div class="row" style="align-items: center;">
                                    <div class="col-sm-8">
                                        <?php if (!empty($project_name)){ ?>
                                            <h2 class="w-title"><?php echo $project_name; ?></h2>
                                        <?php } else { ?>
                                            <h2 class="w-title"><?php echo $post_title; ?></h2>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="w-like">
                                            <a href="<?php echo $post_permalink; ?>"><span class="ion-ios-plus-outline"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_query();
                ?>
            </div>
        </div>
    </section><!-- End Portfolio Section -->
    <?php
}
$args = array(
    'post_type' => 'post',
    'status' => 'publish',
    'posts_per_page' => 3
);

$posts = new WP_Query($args);
if ($posts->have_posts()){
    ?>
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a mb-4">
                            Blog
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                while ($posts->have_posts()){
                    $posts->the_post();
                    $post_title = get_the_title();
                    $post_id = get_the_ID();
                    $feature_image = get_the_post_thumbnail_url();
                    $post_permalink = get_permalink();
                    $post_excerpt = get_blog_content('200', $post_id);
                    $term_obj_list = get_the_terms( $post_id, 'category' );
                    $terms_string = join(' | ', wp_list_pluck($term_obj_list, 'name'));
                    ?>
                    <div class="col-md-4">
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
    </section><!-- End Blog Section -->
    <?php
}
get_footer();
