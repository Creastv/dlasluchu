<?php

add_theme_support('post-thumbnails');
add_image_size('post-futured', 300, 300, array('center', 'center'), true);

if (!function_exists('go_register_nav_menu')) {
    function go_register_nav_menu()
    {
        register_nav_menus(array(
            'primary_menu' => __('Primary Menu', 'go'),
            'footer' => __('Footer', 'go'),
        ));
    }
    add_action('after_setup_theme', 'go_register_nav_menu', 0);
}

require_once get_template_directory() . '/func/enqueue-styles.php';
require_once get_template_directory() . '/func/enqueue-scripts.php';
require get_template_directory() . '/func/clean-up.php';
require get_template_directory() . '/func/wp-cuztomize.php';
require_once get_template_directory() . '/func/contact-form.php';
require_once get_template_directory() . '/func/leads-admin.php';
require_once get_template_directory() . '/func/page-settings.php';



// Paginacja
function pagination_bars()
{
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}
// Excerpt changing 3 dots
function new_excerpt_more($more)
{
    return;
}
add_filter('excerpt_more', 'new_excerpt_more');

// Excerpt
function wp_example_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'wp_example_excerpt_length');


function add_custom_footer_menu_item($items, $args)
{
    if ($args->menu === 'footer') { // Sprawdza, czy to menu "footer"
        $items .= '<li class="menu-item"><a href="#" id="open_preferences_center">Polityka cookies</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_custom_footer_menu_item', 10, 2);
