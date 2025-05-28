<?php
// function async_scripts( $url ) {
// 	if ( strpos( $url, '#asyncload' ) === false ) {
// 		return $url;
// 	} else if ( is_admin() ) {
// 		return str_replace( '#asyncload', '', $url );
// 	} else {
// 		return str_replace( '#asyncload', '', $url ) . "' async='async";
// 	}
// }
// add_filter( 'clean_url', 'async_scripts', 11, 1 );
// function defer_scripts( $url ) {

//     if ( strpos( $url, '#deferload' ) === false ) {
// 		return $url;
// 	} else if ( is_admin() ) {
// 		return str_replace( '#deferload', '', $url );
// 	} else {
// 		return str_replace( '#deferload', '', $url ) . "' defer='defer";
// 	}
// }
// add_filter( 'clean_url', 'defer_scripts', 11, 1 );


function prefix_remove_unnecessary_tags()
{
	// REMOVE WP EMOJI
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');


	// remove all tags from header
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('template_redirect', 'rest_output_link_header', 11);

	// language
	add_filter('multilingualpress.hreflang_type', '__return_false');
}
// add_action('init', 'prefix_remove_unnecessary_tags');

// remove in wordpress jquery-migrate.min.js?ver=3.3.2:2 JQMIGRATE: Migrate is installed, version 3.3.2
add_action('wp_default_scripts', function ($scripts) {
	if (!empty($scripts->registered['jquery'])) {
		$scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
	}
});
add_filter('wpcf7_autop_or_not', '__return_false');


// Wyłączenie komentarzy i pingbacków
function disable_comments_everywhere()
{
	// Wyłączenie wsparcia komentarzy i trackbacków dla wszystkich typów postów
	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'disable_comments_everywhere');

// Ukrycie istniejących komentarzy
function disable_comments_status()
{
	return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

// Ukrycie komentarzy z front-endu
function disable_comments_hide_existing_comments($comments)
{
	return [];
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

// Usunięcie strony komentarzy z kokpitu
function disable_comments_admin_menu()
{
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Przekierowanie z wp-admin/edit-comments.php
function disable_comments_admin_redirect()
{
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit;
	}
}
add_action('admin_init', 'disable_comments_admin_redirect');

// Usunięcie widżetu „Ostatnie komentarze” z Kokpitu
function disable_comments_dashboard()
{
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_comments_dashboard');

// Usunięcie opcji komentowania z paska administracyjnego
function disable_comments_admin_bar()
{
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'disable_comments_admin_bar');
