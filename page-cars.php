<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();?>
	<div id="primary-cars" <?php generate_do_element_classes('content');?>>
		<main id="main-cars" <?php generate_do_element_classes('main');?>>
			<?php
/**
 * generate_before_main_content hook.
 */
do_action('generate_before_main_content');
while (have_posts()): the_post();

    get_template_part('content', 'page');

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || '0' != get_comments_number()):
    ?>
							<div class="comments-area">
								<?php comments_template();?>
							</div>
						<?php
endif;
endwhile;
/**
 * generate_after_main_content hook.
 *
 * @since 0.1
 */
do_action('generate_after_main_content');
?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
/**
 * generate_after_primary_content_area hook.
 */
do_action('generate_after_primary_content_area');
get_footer();
