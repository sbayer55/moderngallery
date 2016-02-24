<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Modern Gallery
 * @subpackage Design-Expression
 * @since Modern Gallery 0.0.2
 */
?>

<?php if (!is_home() && !is_front_page()): ?>
	<div class="container">
		<nav>
			<ul class="pager">
				<?php if (get_next_post_link()): ?>
					<li class="previous">
						<?php echo get_next_post_link('%link', '&larr; %title'); ?>
					</li>
				<?php endif; ?>
				<?php if (get_previous_post_link()): ?>
					<li class="next">
						<?php echo get_previous_post_link('%link', '%title &rarr;'); ?>
					</li>
				<?php endif; ?>
				<!--li class="previous"><a href="#">&larr; Last</a></li>
				<li class="next"><a href="#">Next &rarr;</a></li-->
			</ul>
		</nav>
	</div>
<?php endif; ?>

<footer>
	<?php get_template_part('artwork') ?>


	<section class="container">
		<div class="row">
			<?php for ($n = 1; $n <= 4; $n++): ?>
				<?php if (has_nav_menu('footer_column_'.$n)): ?>
					<div class="col-sm-3">
						<?php
						// All this to get the name of the menu:
						$menu_name = 'footer_column_'.$n;
						$locations = get_nav_menu_locations();
						$menu_id = $locations[ $menu_name ] ;
						$menu = wp_get_nav_menu_object($menu_id);
						?>
						<span style="color: #8A8A8A; margin-bottom: 6px; display: block;">
							<?php echo $menu->name; ?>
						</span>
						<ul class="nav nav-pills nav-stacked" style="border-left: 1px solid #8A8A8A; margin-bottom: 20px;">
							<?php
							$menu_args = array(
								'theme_location' => 'footer_column_'.$n,
								'menu' => 'footer-menu',
								'container' => false,
								'items_wrap' => '%3$s',
							);
							wp_nav_menu($menu_args);
							?>
						</ul>
					</div>
				<?php endif; ?>
			<?php endfor; ?>

		</div><!-- /row -->
	</section>

	<?php wp_footer(); ?>
</footer>

</body>
</html>
