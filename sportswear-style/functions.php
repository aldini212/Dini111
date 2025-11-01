<?php
/**
 * Sportswear Style functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sportswear_Style
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sportswear_style_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register navigation menus.
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary Menu', 'sportswear-style'),
            'footer'  => esc_html__('Footer Menu', 'sportswear-style'),
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // Add support for editor styles.
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');
}
add_action('after_setup_theme', 'sportswear_style_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sportswear_style_content_width() {
    $GLOBALS['content_width'] = apply_filters('sportswear_style_content_width', 1200);
}
add_action('after_setup_theme', 'sportswear_style_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function sportswear_style_scripts() {
    // Theme stylesheet.
    wp_enqueue_style('sportswear-style-style', get_stylesheet_uri(), array(), _S_VERSION);
    
    // Google Fonts
    wp_enqueue_style('sportswear-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap', array(), null);

    // Theme script
    wp_enqueue_script('sportswear-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'sportswear_style_scripts');

/**
 * Register widget area.
 */
function sportswear_style_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'sportswear-style'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'sportswear-style'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'sportswear_style_widgets_init');

/**
 * Load template tags file.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load template functions file.
 */
require get_template_directory() . '/inc/template-functions.php';