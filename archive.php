<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Modern Gallery
 * @subpackage Design-Expression
 * @since Modern Gallery 0.0.2
 */

get_header(); ?>

	<section class="container">
		<div class="row">

			<?php if (is_active_sidebar('sidebar-1')): ?>
				<div class="col-sm-3 col-md-2 sidebar">
					<?php get_sidebar(); ?>
				</div>
				<?php $content_div_class = "col-sm-9 col-md-10"; ?>
			<?php else: ?>
				<?php $content_div_class = "col-sm-12 col-sm-offset-0"; ?>
			<?php endif; ?>

			<!-- Main Content: -->
			<div class="<?php echo $content_div_class; ?>">

				<?php if (have_posts()): ?>
					<?php while (have_posts()): ?>
						<?php the_post(); ?>

						Welcome to the archive!?

					<?php endwhile; ?>

				<?php endif; ?>

			</div> <!-- Right Column (main column) -->
		</div> <!-- row -->
	</section> <!-- container -->


	<script>
		var theme_url = "<?php echo get_template_directory_uri(); ?>";
		var foo;
		$(function () {
		})
	</script>

<?php get_footer(); ?>