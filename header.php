<?php
/**
 * The template for displaying the header.
 *
 * @package GeneratePress
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?> <?php generate_do_microdata('body');?>>
	<header id="main-header" class="clearfix">
		<section id="contact-info" class="clearfix">
			<div class="social">
				<img src="<?php echo get_stylesheet_directory_uri() . '/img/Facebook.png' ?>" alt="">
				<img src="<?php echo get_stylesheet_directory_uri() . '/img/Instagram.png' ?>" alt="">
			</div>
			<div class="contact">
				<div class="phone clearfix">
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/Phone.png' ?>">
					<span>
						+385 91 000 000
					</span>
				</div>
				<div class="email clearfix">
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/Mail.png' ?>">
					<span>
						sacfdsa@dfgd.com
					</span>
				</div>
			</div>
		</section>
		<?php
/**
 * generate_before_header hook.
 *
 * @since 0.1
 *
 * @hooked generate_do_skip_to_content_link - 2
 * @hooked generate_top_bar - 5
 * @hooked generate_add_navigation_before_header - 5
 */
do_action('generate_before_header');

/**
 * generate_header hook.
 *
 * @since 1.3.42
 *
 * @hooked generate_construct_header - 10
 */
do_action('generate_header');

/**
 * generate_after_header hook.
 *
 * @since 0.1
 *
 * @hooked generate_featured_page_header - 10
 */
do_action('generate_after_header');
?>
	</header>
	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">
			<?php
/**
 * generate_inside_container hook.
 *
 * @since 0.1
 */
do_action('generate_inside_container');
