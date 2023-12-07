<?php
/**
 * @package Hello_Irony
 * @version 1.0
 */
/*
Plugin Name: Hello Irony
Plugin URI: https://wp.rmoore.dev/plugins/hello-irony/
Description: This is not just a plugin, it symbolizes the waning hope and dwindling enthusiasm of an entire generation, summed up in three words sung most famously by Alanis Morrissette: Isn’t it ironic? When activated, you will randomly see a lyric from Ironic in the upper right of your admin screen on every page. Forked from the classic “Hello Dolly” plugin by Matt Mullenweg.
Author: Rob Moore
Version: 1.0
Author URI: http://rmoore.dev/
*/

function hello_irony_get_lyric() {
	/** These are the lyrics to Ironic */
	$lyrics = "
An old man turned 98. He won the lottery, and died the next day.
It's a black fly in your Chardonnay.
It's a death row pardon two minutes too late.
Mr. \"Play It Safe\" was afraid to fly. He packed his suitcase and kissed his kids goodbye. He waited his whole damn life to take that flight, and as the plane crashed down, he thought, \"Well, isn't this nice?\"
A traffic jam when you're already late.
A no-smoking sign on your cigarette break.
It's like ten thousand spoons when all you need is a knife.
It's meeting the man of my dreams, and then meeting his beautiful wife.
It's like rain on your wedding day
It's a free ride when you've already paid
It's the good advice that you just didn't take
And who would've thought, it figures
And isn't it ironic, don't you think?";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_irony() {
	$chosen = hello_irony_get_lyric();
	echo "<p id='irony'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_irony' );

// We need some CSS to position the paragraph
function irony_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#irony {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'irony_css' );

?>
