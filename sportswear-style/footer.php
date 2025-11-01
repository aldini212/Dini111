    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="footer-widgets">
            <div class="footer-widget">
                <h3>About Us</h3>
                <p>Premium sportswear inspired by athletic performance and modern style.</p>
            </div>
            <div class="footer-widget">
                <h3>Quick Links</h3>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </div>
            <div class="footer-widget">
                <h3>Contact</h3>
                <p>Email: info@example.com<br>
                Phone: (123) 456-7890</p>
            </div>
            <div class="footer-widget">
                <h3>Newsletter</h3>
                <p>Subscribe for updates and special offers.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email" required>
                    <button type="submit" class="btn">Subscribe</button>
                </form>
            </div>
        </div>
        
        <div class="site-info">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
