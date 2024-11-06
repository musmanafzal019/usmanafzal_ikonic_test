<?php
/**
 * The main template file
 */

get_header();
?>
    <main id="main">
        <?php
        if ( have_posts() ) :

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;
        else :
            //get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
    </main>
<?php
get_footer();
