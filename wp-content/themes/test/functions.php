<?php

/* *****
 * Return the defined polylang languages
 * *****/
function dw_languages()
{
    return pll_the_languages([
        'raw' => 1
    ]);
}

/* *****
 * Return the defined current polylang language
 * *****/
function dw_current_language()
{
    foreach (dw_languages() as $lang) {
        if($lang['current_lang']) return $lang;
    }

    return null;
}

/* *****
 * Return the useful thumbnail attributes
 * *****/
function dw_the_thumbnail_attributes($sizes = [])
{
    // 1. Récupérer le thumbnail pour le post courant dans the loop
    $thumbnail = get_post(get_post_thumbnail_id());
    $thumbnail_meta = get_post_meta($thumbnail->ID);
    $src = null;

    // 2. Récupérer les tailles d'image qui nous intéressent & formater les tailles pour qu'elles soient utilisables dans srcset
    $sizes = array_map(function($size) use ($thumbnail, &$src) {
        $data = wp_get_attachment_image_src($thumbnail->ID, $size);

        if(is_null($src)) {
            $src = $data[0];
        }

        return $data[0] . ' ' . $data[1] . 'w';
    }, $sizes);

    // 4. Formater les attributs
    $srcset = implode(', ', $sizes);
    $alt = $thumbnail_meta['_wp_attachment_image_alt'][0] ?? null;

    // 5. Retourner les attributs générés
    return 'src="' . $src . '" srcset="' . $srcset . '" alt="' . $alt . '"';
}

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
        'supports' => ['title','editor','thumbnail'],
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

/* *****
 * Add theme supports
 * *****/

add_action('after_setup_theme', 'dw_add_theme_supports');

function dw_add_theme_supports()
{
    add_theme_support('post-thumbnails', ['post', 'trip']);
}

/* *****
 * Add custom thumbnail sizes
 * *****/

add_action('after_setup_theme', 'dw_add_image_sizes');

function dw_add_image_sizes() {
    add_image_size('trip-header', 1024, 312, true);
}

/* *****
 * Load text domain
 * *****/

add_action('after_setup_theme', 'dw_load_textdomain');

function dw_load_textdomain() {
    load_textdomain('dw', get_stylesheet_directory() . '/lang/' . get_locale() . '.mo');
}