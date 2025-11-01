<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sportswear_Style
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sportswear_style_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'sportswear_style_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function sportswear_style_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'sportswear_style_pingback_header');

/**
 * Add custom image sizes
 */
function sportswear_style_add_image_sizes() {
    add_image_size('sportswear-featured', 1200, 800, true);
    add_image_size('sportswear-thumbnail', 350, 250, true);
}
add_action('after_setup_theme', 'sportswear_style_add_image_sizes');

/**
 * Add custom classes to navigation menu items
 */
function sportswear_style_nav_menu_css_class($classes, $item, $args, $depth) {
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'sportswear_style_nav_menu_css_class', 10, 4);

/**
 * Add custom classes to navigation menu links
 */
function sportswear_style_nav_menu_link_attributes($atts, $item, $args, $depth) {
    if (isset($args->link_class)) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'sportswear_style_nav_menu_link_attributes', 10, 4);

/**
 * Add a dropdown icon to the menu items with children
 */
function sportswear_style_add_dropdown_icons($output, $item, $depth, $args) {
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        // Add dropdown icon if menu item has children
        if (in_array('menu-item-has-children', $item->classes, true)) {
            $output .= '<span class="dropdown-toggle"><i class="dropdown-icon"></i></span>';
        }
    }
    return $output;
}
add_filter('walker_nav_menu_start_el', 'sportswear_style_add_dropdown_icons', 10, 4);
