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

if (filter_var($_POST['action'], FILTER_SANITIZE_STRING) == 'register_user') {
	$registration_data = [
		'email' => filter_var($_POST['email'], FILTER_SANITIZE_STRING),
		'phone' => filter_var($_POST['phone'], FILTER_SANITIZE_STRING),
		'password' => filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS),
		'first_name' => filter_var($_POST['first_name'], FILTER_SANITIZE_STRING),
		'last_name' => filter_var($_POST['last_name'], FILTER_SANITIZE_STRING),
		'street_1' => filter_var($_POST['street_1'], FILTER_SANITIZE_STRING),
		'street_2' => filter_var($_POST['street_2'], FILTER_SANITIZE_STRING),
		'city' => filter_var($_POST['city'], FILTER_SANITIZE_STRING),
		'state' => filter_var($_POST['state'], FILTER_SANITIZE_STRING),
		'zip' => filter_var($_POST['zip'], FILTER_SANITIZE_STRING),
	];
	foreach ($registration_data as $data) {
		if ($data === false) {
			$registration_data = false;
		}
	}
	if ($registration_data) {
		$query = sprintf(
			"INSERT INTO `thesilentvowel_com`.`commerce_customer` (`email`, `phone`, `password`, `first_name`, `last_name`, `street_1`, `street_2`, `city`, `state`, `zip`) VALUES ('%s','%s',AES_ENCRYPT('%s', 'XKk76N8FLCm23ThJ2CQz'),'%s','%s','%s','%s','%s','%s','%s')",
			$registration_data['email'],
			$registration_data['phone'],
			$registration_data['password'],
			$registration_data['first_name'],
			$registration_data['last_name'],
			$registration_data['street_1'],
			$registration_data['street_2'],
			$registration_data['city'],
			$registration_data['state'],
			$registration_data['zip']);
		$conn = new mysqli('mysql.thesilentvowel.com', 'thesilentvowelco', 'Mageing7', 'thesilentvowel_com');
		$result = $conn->query($query);
		global $message;
		$message = "Sent query!";
	}
	else {
		global $message;
		$message = "something failed.";
	}
}
	else {

		global $message;
		$message = "No user registration data in POST";
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
				<img style="width: 100%; height: 200px; padding: 5px 5px 5px 0px;"
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
					The Silent Vowel Art Gallery is an online space dedicated to showcasing emerging talent in
					contemporary art. Through our unique model - Be Original, Do Good - we are able to invest in our
					artists, our clients, and our future.
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<?php echo $GLOBALS['message']; ?>
	</div>
<?php endif; ?>
