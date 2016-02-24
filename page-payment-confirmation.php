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

get_header();

require_once __DIR__ . '/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('9d5f6dp46sqzjq2q');
Braintree_Configuration::publicKey('79nkfc4hmp92hvn3');
Braintree_Configuration::privateKey('6b01ec075bf1fea66d04493e29c47f5d');

$nonce = $_POST["payment_method_nonce"];
$result = Braintree_Transaction::sale([
	'amount' => '100.00',
	'paymentMethodNonce' => $nonce
])
?>

	<section class="container">
		<h1>Hello</h1>
		<h2 id="token"></h2>
	</section>

	<section class="container">
		<h1>Nonce</h1>
		<p><?php echo $nonce ?></p>
	</section>
	<section class="container">
		<h1>result</h1>
		<p><?php var_dump($result); ?></p>
		<p><?php echo $result ?></p>
	</section>

	<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
	<script>
		var theme_url = "<?php echo get_template_directory_uri(); ?>";
		var foo;

		// We generated a client token for you so you can test out this code
		// immediately. In a production-ready integration, you will need to
		// generate a client token on your server (see section below).
		var clientToken = '<?php echo($clientToken = Braintree_ClientToken::generate()) ?>';

		$(function () {
			//$('#token').html('Token: ' + clientToken);
		})
	</script>

<?php get_footer(); ?>