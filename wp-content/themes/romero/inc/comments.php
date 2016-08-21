<?php
/**
 * Reusable code for adding comments to a page
 *
 * @package Romero
 */

	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template( '', true );
	}