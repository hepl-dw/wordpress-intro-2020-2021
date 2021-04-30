<?php

/* *****
 * Return a compiled asset's URI
 * *****/
function dw_asset($path)
{
    return rtrim(get_template_directory_uri(), '/') . '/public/' . ltrim($path, '/');
}

/* *****
 * Register a custom post type
 * *****/

add_action('init', 'dw_custom_post_type');

function dw_custom_post_type() {
    register_post_type('trip', [
        'label' => 'Voyages',
        'labels' => [
            'singular_name' => 'Voyage',
            'add_new_item' => 'Ajouter un nouveau voyage',
        ],
        'description' => 'Tous les voyages que nous avons pu vivre jusqu\'à ce jour.',
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-palmtree',
    ]);
}

/* *****
 * Disable the Wordpress Gutenberg Editor
 * *****/

add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor");

function disable_gutenberg_editor()
{
    return false;
}