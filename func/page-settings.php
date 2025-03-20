<?php
function custom_page_options_meta_box()
{
    add_meta_box(
        'custom_page_options',
        'Dodatkowe opcje podstrony',
        'render_custom_page_options_meta_box',
        'page', // tylko dla podstron
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_page_options_meta_box');

function render_custom_page_options_meta_box($post)
{
    $disable_title = get_post_meta($post->ID, '_disable_title', true);
    $disable_form = get_post_meta($post->ID, '_disable_form', true);

    wp_nonce_field('save_custom_page_options', 'custom_page_options_nonce');
?>
    <p>
        <label>
            <input type="checkbox" name="disable_title" value="1" <?php checked($disable_title, '1'); ?> />
            Wyłącz tytuł
        </label>
    </p>
    <p>
        <label>
            <input type="checkbox" name="disable_form" value="1" <?php checked($disable_form, '1'); ?> />
            Wyłącz formularz
        </label>
    </p>
<?php
}

function save_custom_page_options($post_id)
{
    if (!isset($_POST['custom_page_options_nonce']) || !wp_verify_nonce($_POST['custom_page_options_nonce'], 'save_custom_page_options')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    update_post_meta($post_id, '_disable_title', isset($_POST['disable_title']) ? '1' : '');
    update_post_meta($post_id, '_disable_form', isset($_POST['disable_form']) ? '1' : '');
}
add_action('save_post', 'save_custom_page_options');
