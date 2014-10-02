<?php
/*
Plugin Name: Heganoo Shortcode
Description: Enables shortcode to embed Heganoo maps.
Version: 1.0
License: GPLv2
Author: Konforti / Heganoo
Author URI: http://heganoo.com
*/

/**
 * Implements add_shortcode.
 *
 * @param      $atts
 * @param null $content
 *
 * @return string
 */
function heganooEmbedJS( $atts, $content = null ) {

	// Set default values.
	extract( shortcode_atts( array(
			'href'            => '',
			'width'           => '100%',
			'height'          => '600px',
			'popup'           => 'false',
			'popupimg'        => '',
			'allowfullscreen' => 'true'
	), $atts ) );

	if ( ! $href ) {

		// The href is mandatory.
		$error = "
		<div style='border: 20px solid red; border-radius: 40px; padding: 40px; margin: 50px 0 70px;'>
			<h3>Uh oh!</h3>
			<p style='margin: 0;'>Something is wrong with your Heganoo shortcode.
		</div>";

		return $error;

	} else {

		// Set the output.
		$output = "";
		$output .= "<div class='heganoo-map' data-href='$href' data-width='$width' data-height='$height' data-popup='$popup' data-popup-img='$popupimg' data-allowfullscreen='$allowfullscreen'></div>\n";
		$output .= "<script>(function(d,s,id){var js, fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src='http://heganoo.com/js/embed.js';fjs.parentNode.insertBefore(js,fjs);}(document,'script','heganoo-embed'));</script>\n";

		// iframe embed, loaded inside <noscript> tags.
		$output .= "<noscript><iframe width='$width' height='$height' style='border: 0;' src='$href' allowfullscreen='$allowfullscreen' ></iframe></noscript>";

		return $output;
	}
}

/**
 * Register Heganoo shortcode.
 */
add_shortcode( 'heganoo', 'heganooEmbedJS' );