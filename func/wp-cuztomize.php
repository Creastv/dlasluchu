<?php


function register_header_settings($wp_customize)
{
    // Dodanie sekcji dla zakładki "Header"
    $wp_customize->add_section('header_section', [
        'title'    => __('Ustawienia Headera', 'go'),
        'priority' => 50,
    ]);



    // ✉️ Ustawienie dla adresu e-mail
    $wp_customize->add_setting('header_button_text', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('header_button_text', [
        'label'   => __('Button tekst', 'go'),
        'section' => 'header_section',
        'type'    => 'text',
    ]);

    // 📝 Ustawienie dla krótkiego opisu
    $wp_customize->add_setting('header_button_link', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('header_button_link', [
        'label'   => __('button link', 'go'),
        'section' => 'header_section',
        'type'    => 'text',
    ]);
}
add_action('customize_register', 'register_header_settings');