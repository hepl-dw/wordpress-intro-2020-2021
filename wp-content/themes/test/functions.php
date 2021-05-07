<?php

/* *****
 * Return a menu structure for display
 * *****/
function dw_bem($base, $modifiers = [])
{
    $classes = array_map(function($modifier) use ($base) {
        return $base . '--' . $modifier;
    }, $modifiers);

    return implode(' ', $classes);
}

/* *****
 * Return a menu structure for display
 * *****/
function dw_menu($location)
{
    // 1. Récupérer l'identifiant (WP_post) de mon menu $location
    $locations = get_nav_menu_locations();
    $menu = $locations[$location];

    // 2. Récupérer les liens (instances WP_Post) du menu en question
    $links = wp_get_nav_menu_items($menu);

    // 3. Formater les objets (liens) récupérés pour qu'ils soient utilisables
    $links = array_map(function($result) {
        // Récupérer l'objet de la page courante
        global $post;

        $link = new \stdClass();

        $link->url = $result->url;
        $link->label = $result->title;
        $link->modifiers = [];

        // Est-ce que le lien représente la page courante ?
        if(intval($result->object_id) === intval($post->ID)) {
            $link->modifiers[] = 'current';
        }

        // Est-ce que le lien possède une icone (ACF) à afficher ?
        if($icon = get_field('icon', $result->ID)) {
            $link->modifiers[] = $icon;
        }

        return $link;
    }, $links);

    // 4. Retourner le tableau ainsi créé
    return $links;
}


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
        'rewrite' => [
            'slug' => 'voyages'
        ]
    ]);
}

/* *****
 * Register navigation menus
 * *****/

add_action('init', 'dw_custom_navigation_menus');

function dw_custom_navigation_menus() {
    register_nav_menus([
        'main' => 'Navigation principale',
        'footer' => 'Navigation en pied de page',
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