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

$terms = get_terms('collection', ['number' => 3]);
?>

<?php foreach ($terms as $term): ?>
	<?php
	$args = [
		'post_type' => 'artwork',
		'posts_per_page' => 4,
		'orderby' => 'rand',
		'tax_query' => [[
			'taxonomy' => 'collection',
			'field' => 'name',
			'terms' => $term->name
		]]
	];
	$taxonomy = new WP_Query($args);
	?>

	<?php if ($taxonomy->have_posts()): ?>
		<?php $taxonomy->the_post(); ?>
		<div class="col-sm-6 col-md-4" style="margin-bottom: 40px;">
			<?php if ($taxonomy->found_posts >= 4): ?>
				<div class="">
					<a href="<?php the_permalink(); ?>">
						<div class="col-xs-12"
							 style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size: cover; height: 200px">
						</div>
					</a>
					<?php while ($taxonomy->have_posts()): $taxonomy->the_post(); ?>
						<a href="<?php the_permalink(); ?>">
							<div class="col-xs-4"
								 style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size: cover; height: 100px">
							</div>
						</a>
					<?php endwhile; ?>
					<div class="clearfix"></div>
				</div>
			<?php else: ?>
					<a href="<?php the_permalink(); ?>">
						<div style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size: cover; height: 300px">
						</div>
					</a>
			<?php endif; ?>
			<h3>
				<a href="<?php echo get_term_link($term); ?>">
					<?php echo $term->name; ?>
				</a>
			</h3>
		</div>
	<?php endif; ?>


	<?php wp_reset_query(); ?>
<?php endforeach; ?>