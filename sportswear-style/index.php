<?php
/**
 * The main template file
 *
 * @package Sportswear_Style
 */

get_header();
?>

<div class="site">
    <div class="site-content">
        <main id="primary" class="content-area">
            <?php
            if (have_posts()) :
                if (is_home() && !is_front_page()) :
                    ?>
                    <header class="page-header">
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                endif;

                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;

                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&larr; Previous', 'sportswear-style'),
                    'next_text' => __('Next &rarr;', 'sportswear-style'),
                ));
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
        </main><!-- #primary -->

        <?php get_sidebar(); ?>
    </div><!-- .site-content -->
</div><!-- .site -->

<?php
get_footer();
