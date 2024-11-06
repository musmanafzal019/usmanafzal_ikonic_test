<?php
/**
 * The template for displaying archive pages
 */

get_header();
if (have_posts()){
    ?>
    <!-- ======= Portfolio Section ======= -->
    <section id="work" class="portfolio-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <?php
                while (have_posts()){
                    the_post();
                    $feature_image = get_the_post_thumbnail_url();
                    $post_permalink = get_permalink();
                    $project_name = get_field('project_name', false, false);
                    ?>
                    <div class="col-md-4">
                        <div class="work-box">
                            <a href="<?php echo $post_permalink; ?>" data-gall="portfolioGallery" class="venobox">
                                <div class="work-img">
                                    <img src="<?php echo $feature_image; ?>" alt="" class="img-fluid">
                                </div>
                            </a>
                            <div class="work-content">
                                <div class="row" style="align-items: center;">
                                    <div class="col-sm-8">
                                        <h2 class="w-title"><?php echo $project_name; ?></h2>
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
                ?>
            </div>
            <div class=" text-center">
                <span class="m-4"><?php wp_pagenavi(); ?></span>
            </div>
        </div>
    </section><!-- End Portfolio Section -->
    <?php
    wp_reset_query();
}
?>
<?php
get_footer();
