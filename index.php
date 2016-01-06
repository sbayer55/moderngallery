<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Bootstrap
 * @subpackage Design-Expression
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
				<div class="row">
					<?php if (have_posts()): ?>
						<?php while (have_posts()): ?>
							<?php the_post(); ?>


							<?php if (has_post_thumbnail()): ?><!-- Image post: -->
								<div class="col-sm-4">
									<a href="<?php the_permalink(); ?>" class="thumbnail">
										<img src="<?php the_post_thumbnail_url(); ?>">
									</a>
								</div>
								<div class="col-sm-8">
									<div>
										<h1><?php the_title(); ?></h1>
									</div>
									<div>
										<?php the_content(); ?>
									</div>
								</div>
								<div class="clearfix"></div>


							<?php else: ?><!-- No image post: -->
								<div class="col-sm-12">
									<a href="<?php the_permalink(); ?>">
										<div>
											<h1><?php the_title(); ?></h1>
										</div>
										<div>
											<?php the_content(); ?>
										</div>
									</a>
								</div>
							<?php endif; ?>


						<?php endwhile; ?>

					<?php endif; ?>

				</div> <!-- Row -->
			</div> <!-- Right Column (main column) -->
		</div> <!-- row -->
	</section> <!-- container -->


	<script>
		var theme_url = "<?php echo get_template_directory_uri(); ?>";
		var foo;
		$(function () {
			$.ajaxSetup({
				url: '/wp-admin/admin-ajax.php',
				type: 'POST',
				dataType: 'JSON'
			})
			$.ajax({url: '/wp-admin/admin-ajax.php', type: 'POST', data: {action: 'test_connection'}, dataType: 'JSON'})
				.done(function (data, status, jqXHR) {
					console.log(data);
					console.log(status);
					foo = data;
				})
				.fail(function (data, status, jqXHR) {
					console.log("AJAX failed...");
				})
				.always(function () {
					console.log("AJAX done.");
				});
		})
	</script>

<?php get_footer(); ?>