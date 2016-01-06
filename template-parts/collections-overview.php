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

$terms = get_terms('collection');
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
		<div class="row">
			<h1 class="col-xs-12">
				<?php echo $term->name; ?>
			</h1>
			<?php while ($taxonomy->have_posts()): $taxonomy->the_post(); ?>
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
		</div>
	<?php endif; ?>

	<?php wp_reset_query(); ?>
<?php endforeach; ?>