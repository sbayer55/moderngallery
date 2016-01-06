<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Bootstrap
 * @subpackage Design-Expression
 */


$args = [
	'post_type' => 'artwork',
	'posts_per_page' => 4,
	'orderby' => 'rand'
];

$artwork = new WP_Query($args); ?>

	<aside id="artworks" class="container">
		<h3 style="color:#8A8A8A;">Recommended for you</h3>
		<div class="row">
			<?php if ($artwork->have_posts()): ?>
				<?php while ($artwork->have_posts()): $artwork->the_post(); ?>
					<div class="col-sm-3">
						<a href="<?php the_permalink(); ?>" class="thumbnail thumbnail-fixed">
							<div style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
								<div class="slide-up-on-hover">
									<div class="">
										<span class="title"><?php the_title(); ?></span>
									</div>
								</div>
							</div>
						</a>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</aside>

<?php
wp_reset_query();