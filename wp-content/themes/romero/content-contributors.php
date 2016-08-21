<?php
/**
 * Contributors listing
 *
 * @package Romero
 */

$contributor_ids = get_users(
	array(
		'fields'  => 'ID',
		'order'   => 'DESC',
		'who'     => 'authors',
	)
);

foreach ( $contributor_ids as $contributor_id ) {
	
	$post_count = count_user_posts( $contributor_id );

	// Move on if user has not published a post (yet).
	if ( ! $post_count ) {
		continue;
	}

	romero_contributor( $contributor_id, $post_count );

}