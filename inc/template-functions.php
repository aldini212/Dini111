<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Dini111
 */

if (!function_exists('dini111_body_classes')) :
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    function dini111_body_classes($classes) {
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
    add_filter('body_class', 'dini111_body_classes');
endif;

if (!function_exists('dini111_pingback_header')) :
    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     */
    function dini111_pingback_header() {
        if (is_singular() && pings_open()) {
            printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
        }
    }
    add_action('wp_head', 'dini111_pingback_header');
endif;

if (!function_exists('dini111_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function dini111_theme_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Register navigation menus.
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary Menu', 'dini111'),
                'footer'  => esc_html__('Footer Menu', 'dini111'),
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
    add_action('after_setup_theme', 'dini111_theme_setup');
endif;

if (!function_exists('dini111_content_width')) :
    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     */
    function dini111_content_width() {
        $GLOBALS['content_width'] = apply_filters('dini111_content_width', 1200);
    }
    add_action('after_setup_theme', 'dini111_content_width', 0);
endif;

if (!function_exists('dini111_scripts')) :
    /**
     * Enqueue scripts and styles.
     */
    function dini111_scripts() {
        // Theme stylesheet.
        wp_enqueue_style('dini111-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

        // Theme script.
        wp_enqueue_script('dini111-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
    add_action('wp_enqueue_scripts', 'dini111_scripts');
endif;

if (!function_exists('dini111_widgets_init')) :
    /**
     * Register widget area.
     */
    function dini111_widgets_init() {
        register_sidebar(
            array(
                'name'          => esc_html__('Sidebar', 'dini111'),
                'id'            => 'sidebar-1',
                'description'   => esc_html__('Add widgets here.', 'dini111'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
    add_action('widgets_init', 'dini111_widgets_init');
endif;