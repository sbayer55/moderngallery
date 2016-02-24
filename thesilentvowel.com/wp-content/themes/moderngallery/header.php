<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Modern Gallery
 * @subpackage Design-Expression
 * @since Modern Gallery 0.0.2
 */

// Load any external files you have here
global $uuid;
if (isset($_COOKIE['uuid'])) {
	global $uuid;
	$uuid = $_COOKIE['uuid'];
}
else {
	global $uuid;
	$uuid = uniqid();
	setcookie("uuid", $uuid, time() + (86400 * 30), "/"); // 86400 = 1 day
}

?><!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body>
<?php if (has_nav_menu('primary')): ?>
	<div class="container">
		<div class="row row-wide">
			<div class="col-sm-3">
				<img style="width: 250px; height: 200px; padding: 5px 5px 5px 0px;"
					 src="<?php echo get_bloginfo('template_directory'); ?>/images/brand.svg" alt="The Silent Vowel">
			</div>
			<div class="col-sm-9">
					<div id="collapse-primary-menu" class="collapse navbar-collapse navbar-modern">
						<ul class="nav navbar-nav">
							<?php
							$menu_args = array(
								'theme_location' => 'primary',
								'menu' => 'primary-menu',
								'container' => false,
								'before' => '', // here <a href=""> link </a>
								'after' => '', // <a href=""> Link </a> here
								'link_before' => '', // <a href=""> here Link </a>
								'link_after' => '', // <a href=""> Link here </a>
								'items_wrap' => '%3$s',
							);
							wp_nav_menu($menu_args);
							?>
						</ul>
					</div><!-- navbar -->
					<div>
						The Silent Vowel Art Gallery is an online space dedicated to showcasing emerging talent in contemporary art.  Through our unique model - Be Original, Do Good - we are able to invest in our artists, our clients, and our future.
					</div>
			</div>
		</div>
	</div>
<div class="container">

</div>
<?php endif; ?>
