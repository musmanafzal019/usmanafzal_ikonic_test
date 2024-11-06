<?php
/**
 * The template for displaying all single posts
 */

get_header();
while ( have_posts() ) {
    the_post();
    $post_title = get_the_title();
    $post_content = get_the_content();
    $feature_image = get_the_post_thumbnail_url();
    $post_permalink = get_permalink();
    $project_name = get_field('project_name', false, false);
    $project_description = get_field('project_description', false, false);
    $project_start_date = get_field('project_start_date', false, false);
    $project_start_date = DateTime::createFromFormat( 'Ymd', $project_start_date );
    $project_end_date = get_field('project_end_date', false, false);
    $project_end_date = DateTime::createFromFormat( 'Ymd', $project_end_date );
    $project_url = get_field('project_url', false, false);
    $blah = parse_url($project_url);
    ?>
    <!-- ======= Portfolio Details Section ======= -->
    <section class="portfolio-details sect-4">
        <div class="container">

            <div class="portfolio-details-container">

                <div class="owl-carousel portfolio-details-carousel">
                    <?php if (!empty($feature_image)){ ?>
                        <img src="<?php echo $feature_image; ?>" class="img-fluid" alt="">
                    <?php } else { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/post-3.jpg" class="img-fluid" alt="">
                    <?php } ?>
                </div>
                <?php if (!empty($project_start_date) || !empty($project_end_date) || !empty($project_url)){ ?>
                    <div class="portfolio-info">
                        <h3>Project information</h3>
                        <ul>
                            <li><strong>Project Start Date</strong>: <?php echo $project_start_date->format('d M, Y'); ?></li>
                            <li><strong>Project End Date</strong>: <?php echo $project_end_date->format('d M, Y'); ?></li>
                            <li><strong>Project URL</strong>: <a href="<?php echo $project_url; ?>"><?php echo $blah['host']; ?></a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>

            <div class="portfolio-description">
                <?php if (!empty($project_name)){ ?>
                    <h2 class="w-title"><?php echo $project_name; ?></h2>
                <?php } else { ?>
                    <h2 class="w-title"><?php echo $post_title; ?></h2>
                    <?php
                }
                if (!empty($project_description)){
                    echo $project_description;
                } else {
                    echo $post_content;
                }
                ?>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->
    <?php
}
get_footer();
