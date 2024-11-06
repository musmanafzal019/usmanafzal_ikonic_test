<?php
if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '1.0.0' );
}

function ikonictest_setup(){

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'ikonictest' ),
        )
    );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    add_theme_support(
        'custom-background',
        apply_filters(
            'ikonictest_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    add_theme_support( 'customize-selective-refresh-widgets' );

    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}

add_action( 'after_setup_theme', 'ikonictest_setup' );

function ikonictest_scripts() {
    wp_enqueue_style( 'ikonictest-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'ikonictest-style', 'rtl', 'replace' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ikonictest_scripts' );

function create_custom_posttype() {

    register_post_type( 'projects',
        array(
            'labels' => array(
                'name' => __( 'Projects' ),
                'singular_name' => __( 'Project' ),
                'parent_item_colon'   => __( 'Parent Project'),
                'all_items'           => __( 'All Projects'),
                'view_item'           => __( 'View Project'),
                'add_new_item'        => __( 'Add New Project'),
                'add_new'             => __( 'Add New'),
                'edit_item'           => __( 'Edit Project'),
                'update_item'         => __( 'Update Project'),
                'search_items'        => __( 'Search Project'),
                'not_found'           => __( 'Not Found'),
                'not_found_in_trash'  => __( 'Not found in Trash'),
            ),
            'rewrite' => array('slug' => 'project','with_front' => false),
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => 'projects',
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
        )
    );
}

add_action( 'init', 'create_custom_posttype' );

function get_blog_content( $count, $id ) {
    $excerpt = get_the_content($id);
    $shortcode = do_shortcode($excerpt);
    $excerpt = strip_tags($shortcode);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = $excerpt. '...';
    return $excerpt;
}

function my_register_route_project() {
    register_rest_route( 'ik', 'get_projects', array(
            'methods' => 'GET',
            'callback' => 'get_custom_projects',
        )
    );
}

function get_custom_projects() {
    $datapaged = ($_GET['datapaged']) ? $_GET['datapaged'] : false;
    $start_date = preg_replace("([^0-9/])", "", $_GET['start_date']);
    $end_date = preg_replace("([^0-9/])", "", $_GET['end_date']);

    $args = array(
        'post_type' => 'projects',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'paged' => $datapaged,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'project_start_date',
                'value' => array( $start_date, $end_date ),
                'compare' => 'BETWEEN',
                'type' => 'DATE,'
            ),array(
                'key' => 'project_end_date',
                'value' => array( $start_date, $end_date ),
                'compare' => 'BETWEEN',
                'type' => 'DATE,'
            )
        ),
    );

    $projects = new WP_Query($args);

    $project_array = array();
    if ($projects->have_posts()){
        while ($projects->have_posts()){
            $projects->the_post();
            $post_title = get_the_title();
            $feature_image = get_the_post_thumbnail_url();
            $project_name = get_field('project_name', false, false);
            $project_start_date = get_field('project_start_date', false, false);
            $project_start_date = DateTime::createFromFormat( 'Ymd', $project_start_date );
            $project_end_date = get_field('project_end_date', false, false);
            $project_end_date = DateTime::createFromFormat( 'Ymd', $project_end_date );
            $project_url = get_field('project_url', false, false);

            if (!empty($project_name)){
                $project_title = $project_name;
            } else{
                $project_title = $post_title;
            }

            $project_array[] = array(
                'project_title' => $project_title,
                'project_image_url' => $feature_image,
                'project_url' => $project_url,
                'project_start_date' => $project_start_date->format('d M, Y'),
                'project_end_date' => $project_end_date->format('d M, Y')
            );

        }
    } else {
        $project_array = array('message' => 'No posts found.');
    }

    wp_send_json($project_array);

}

add_action( 'rest_api_init', 'my_register_route_project' );