<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/ionicons.min.css" rel="stylesheet">
</head>
<?php
wp_head();
?>
<body>
<!-- ======= Header/ Navbar ======= -->
<nav class="navbar navbar-b navbar-expand-md fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll" href="/">UsmanFolio</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
            <?php
            $defaults = array(
                'theme_location' => 'menu-1',
                'container' => 'ul',
                'menu_class' => 'navbar-nav',
            );
            wp_nav_menu($defaults);
            ?>
        </div>
    </div>
</nav>
<?php
$title = '';
if (is_archive()){
    $queried = get_queried_object();
    $title = $queried->label;
} elseif(is_home()){
    $title = 'Blog';
} else{
    $title = get_the_title();
}
?>
<div class="intro intro-single route">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4"><?php echo $title; ?></h2>
                <?php
                if (!is_front_page()){
                    ?>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo $title; ?></li>
                    </ol>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

