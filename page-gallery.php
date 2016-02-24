<?php
/**
 * Template file for Gallery Collections
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Modern Gallery
 * @subpackage Design-Expression
 * @since Bootstrap 0.0.2
 */

get_header(); ?>

<section class="container">
	<h1>Browse Gallery</h1>
	<?php if (have_posts()): ?>
		<?php while (have_posts()): ?>
			<?php the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php get_template_part('template-parts/artwork-samples'); ?>
</section>

<script>
	var theme_url = "<?php echo get_template_directory_uri(); ?>";
	var foo;
	$(function () {
		$.ajaxSetup({
			url: '/wp-admin/admin-ajax.php',
			type: 'POST',
			dataType: 'JSON'
		});
	})
</script>

<?php get_footer(); ?>
