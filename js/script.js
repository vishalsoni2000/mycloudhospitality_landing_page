/*!
 * Author: Pushpendra Kr. Sharma
 */

/* for Mobile View */
var viewport = jQuery(window).innerWidth();
if( viewport < 767 )
{
	$( ".form-area" ).insertBefore( ".content" );  
}

