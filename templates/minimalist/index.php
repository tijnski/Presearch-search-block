<?php
/**
 * Minimalist Startpage Theme
 *
 * @package Startpage
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New tab</title>
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( plugins_url( 'index.css', __FILE__ ) ); ?>" />
</head>
<body>
	<div id="root">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();

		endwhile;
		?>
	</div>
<?php wp_footer(); ?>
</body>
</html>
